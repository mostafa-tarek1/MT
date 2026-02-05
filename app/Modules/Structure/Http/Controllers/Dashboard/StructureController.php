<?php

namespace App\Modules\Structure\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use function App\Modules\Base\Http\Helpers\array_merge_recursive_distinct;

use App\Modules\Base\Http\Traits\FileTrait;
use App\Modules\Structure\Repository\StructureRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

abstract class StructureController extends Controller
{
    use FileTrait;

    protected string $contentKey;

    protected array $locales;

    protected StructureRepositoryInterface $structureRepository;

    public function __construct(
        StructureRepositoryInterface $structureRepository,
    ) {
        // $this->middleware('auth:api-manager');

        // $this->middleware('permission:structures-read')->only('index');
        // $this->middleware('permission:structures-update')->only('_store');

        $this->structureRepository = $structureRepository;
    }

    final public function index()
    {
        $content = json_decode((string) $this->structureRepository->structure($this->contentKey)?->content, true);
        return view('structure::dashboard.'.$this->contentKey, compact('content'));
    }

    public function _store(Request $request)
    {
        $content = $this->build($request);
        $this->structureRepository->publish($this->contentKey, $content);

        return redirect()->back()->with('success', __('messages.created successfully'));
    }

    protected function build($request)
    {
        $data = $this->file($request);

        $result = [];
        foreach ($data as $locale => $content) {

            if (in_array($locale, $this->locales)) {
                $result[$locale] = $content;
                if (isset($data['all'])) {
                    $result[$locale] = array_merge_recursive_distinct($result[$locale], $data['all']);
                }
            }
        }

        $safe_array = $this->safeArray($result);

        return json_encode($this->safeJson($safe_array));
    }

    protected function file($request)
    {
        $data = $request->all();
        if (isset($data['old_file'])) {
            if (is_array($data['old_file'])) {
                foreach ($data['old_file'] as $i => $oldFile) {
                    $oldFilePath = str_replace(url('/'), '', $oldFile);
                    // Remove 'storage/' prefix if exists
                    $oldFilePath = str_replace('storage/', '', $oldFilePath);

                    if (is_array($request->file('file')) && isset($request->file('file')[$i])) {
                        // Delete old file
                        $this->deleteFile($oldFilePath);

                        // Upload new file
                        $file = $request->file('file')[$i];
                        $filePath = $file->store('content/'.$this->contentKey, 'public');

                        $this->assignFilesUrls($data, 'file_'.$i, url('storage/'.$filePath));
                    } else {
                        $this->assignFilesUrls($data, 'file_'.$i, url('storage/'.$oldFilePath));
                    }
                }
            }
        }

        return $data;
    }

    protected function safeArray($value): array
    {
        if (is_array($value)) {
            return $value;
        }
        if (is_object($value)) {
            return json_decode(json_encode($value), true) ?? [];
        }

        return [];
    }

    protected function safeJson($value)
    {
        if (is_string($value)) {
            return $value;
        }

        return json_decode(json_encode($value), true);
    }

    private function assignFilesUrls(&$data, $search, $replace)
    {
        foreach ($data as &$value) {
            if (is_array($value)) {
                $this->assignFilesUrls($value, $search, $replace);
            } elseif ($value == $search) {
                $value = $replace;
            }
        }
    }
}
