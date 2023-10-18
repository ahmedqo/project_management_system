<?php

namespace App\Functions;

use App\Models\Document;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentFn
{
    public static $BASEPATH = "public/";

    public static function store($file, $path = '')
    {
        $path = substr(Storage::putFile(DocumentFn::$BASEPATH . $path, $file), strlen('public/'));
        $name = $file->getClientOriginalName();
        $type = $file->getClientMimeType();
        $size = $file->getSize();

        return Document::create([
            'name' => $name,
            'path' => $path,
            'type' => $type,
            'size' => $size,
        ]);
    }

    public static function destroy($file, $path = '')
    {
        $data = Document::where('id', $file)->first();
        if (Storage::exists(DocumentFn::$BASEPATH . $path . $data->path))
            Storage::delete(DocumentFn::$BASEPATH . $path . $data->path);
        $data->delete();
    }

    public static function getClientDoc($id)
    {
        $docs = DB::table('client_document')
            ->join('documents', 'client_document.document', '=', 'documents.id')
            ->where('client_document.client', $id)
            ->get();

        foreach ($docs as $doc) {
            $doc->{'doc'} = asset('storage/' . $doc->path);
        }

        return $docs->reverse();
    }
}
