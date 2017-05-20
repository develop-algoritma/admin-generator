@php echo "<?php"
@endphp namespace {{ $namespace }};

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{{ $modelFullName }};

class {{ $className }} extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO add authorization

        return view('admin.{{ $objectName }}.index', [
            '{{ $objectNamePlural }}' => {{ $modelName }}::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // TODO add authorization

        return view('admin.{{ $objectName }}.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO add authorization

        // Validate the request
        $this->validate($request, [
            @foreach($columns as $column)'{{ $column['name'] }}' => '{{ implode('|', (array) $column['rules']) }}',
            @endforeach

        ]);

        // Sanitize input
        $sanitized = $request->only([
            @foreach($columns as $column)'{{ $column['name'] }}',
            @endforeach

        ]);

        // Store the {{ $objectName }}
        {{ $modelName }}::create($sanitized);

        return redirect('admin/{{ $objectName }}')
            ->withSuccess("Created");
    }

    /**
     * Display the specified resource.
     * @param  {{ $modelName }} ${{ $objectName }}
     * @return \Illuminate\Http\Response
     */
    public function show({{ $modelName }} ${{ $objectName }})
    {
        // TODO add authorization
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  {{ $modelName }} ${{ $objectName }}
     * @return \Illuminate\Http\Response
     */
    public function edit({{ $modelName }} ${{ $objectName }})
    {
        // TODO add authorization

        return view('admin.post.edit', [
            '{{ $objectName }}' => ${{ $objectName }},
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  {{ $modelName }} ${{ $objectName }}
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, {{ $modelName }} ${{ $objectName }})
    {
        // TODO add authorization

        // Validate the request
        $this->validate($request, [
            @foreach($columns as $column)'{{ $column['name'] }}' => '{{ implode('|', (array) $column['rules']) }}',
            @endforeach

        ]);

        // Sanitize input
        $sanitized = $request->only([
            @foreach($columns as $column)'{{ $column['name'] }}',
            @endforeach

        ]);

        // Update changed values {{ $objectName }}
        ${{ $objectName }}->update($sanitized);

        return redirect('admin/{{ $objectName }}')
            ->withSuccess("Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  {{ $modelName }} ${{ $objectName }}
     * @return \Illuminate\Http\Response
     */
    public function destroy({{ $modelName }} ${{ $objectName }})
    {
        // TODO add authorization

        ${{ $objectName }}->delete();

        return redirect()->back()
            ->withSuccess("Deleted");
    }

}
