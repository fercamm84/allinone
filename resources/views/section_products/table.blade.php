<table class="table table-responsive" id="sectionProducts-table">
    <thead>
        <tr>
            <th>Product Id</th>
        <th>Section Id</th>
        <th>Active</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($sectionProducts as $sectionProduct)
        <tr>
            <td>{!! $sectionProduct->product_id !!}</td>
            <td>{!! $sectionProduct->section_id !!}</td>
            <td>{!! $sectionProduct->active !!}</td>
            <td>
                {!! Form::open(['route' => ['sectionProducts.destroy', $sectionProduct->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('sectionProducts.show', [$sectionProduct->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('sectionProducts.edit', [$sectionProduct->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>