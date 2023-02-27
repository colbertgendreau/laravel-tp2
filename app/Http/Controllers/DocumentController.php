<?php
namespace App\Http\Controllers;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response; // pour download
class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::select()
            ->paginate(10);
        // $documents = Document::all();
        //return $documents[0]->title;
        return view('document.index', ['documents' => $documents]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        $userId = Auth::user()->id; // chercher le id de l'user
        // return 'view document';
        return view('document.show', ['document' => $document], ['userId' => $userId]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('document.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'path' => 'required|mimes:pdf,zip,doc',
        ]);
        // https://makitweb.com/how-to-upload-a-file-in-laravel-8/
        $file = $request->path;
        $filename = time() . '_' . $file->getClientOriginalName();
        $location = 'public/uploads/';



        $file->storeAs($location, $filename);
        $newDocument = Document::create([
            'title' => $request->title,
            'title_fr' => $request->title_fr,
            'path'  => $location . $filename,
            'user_id' => Auth::user()->id,
        ]);
        return redirect(route('document.index', $newDocument->id));
    }
    /**
     * download file
     * 
     * @param \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Auth\Access\Response
     */
    public function download(Document $document)
    {
        $dossier = $document->path;
        $path = storage_path('app/' . $dossier);
        $fileName = $document->title;

        
        echo " path : ";
        echo $path;
        echo " filemane : ";
        echo $fileName;

        return Response::download($path, $fileName);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        $userId = Auth::user()->id; // chercher le id de l'user
        $documentId = $document->user_id;
        if ($userId == $documentId) {
            return view('document.edit', ['document' => $document]);
        } else {
            $documents = Document::all();
            return view('document.index', ['documents' => $documents]);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        $request->validate([
            'title' => 'required',
        ]);
        //update where document->id  => select where document->id
        $document->update([
            'title' => $request->title,
            'title_fr' => $request->title_fr,
        ]);
        return redirect(route('blog.show', $document->id));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $document->delete();
        return redirect(route('dashboard'));
    }
}
