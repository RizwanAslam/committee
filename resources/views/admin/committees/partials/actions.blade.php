<a href="{{ route('committees.edit', $committee->id) }}" role="button" class="btn"
   style="padding-left: 0px; margin-left: 0px"><i class="icon-feather-edit"></i></a>
<a href="{{ route('committees.destroy', $committee->id) }}" role="button" class="btn"
   style="padding-left: 0px; margin-left: 0px" onclick="event
        .preventDefault();
        document.getElementById('delete-form-{{ $committee->id }}').submit();"><i class="icon-feather-trash"></i></a>
<a href="{{ route('committees.show', $committee->id) }}" role="button" class="btn"
   style="padding-left: 0px; margin-left: 0px"><i class="icon-feather-eye"></i></a>
<a role="button" href="{{ route('committee-members.create',$committee->id) }}" class="btn"
   style="padding-left: 0px; margin-left: 0px"><i class="icon-feather-plus-circle"></i></a>

<form id="delete-form-{{ $committee->id }}"
      action="{{ route('committees.destroy', $committee->id) }}" method="POST"
      style="display: none;">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>

