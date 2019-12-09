<a href="{{ route('members.show', $member->id) }}" role="button" class="btn"
   style="padding-left: 0px; margin-left: 0px"><i class="icon-feather-eye"></i></a>
<a href="{{ route('members.edit', $member->id) }}" role="button" class="btn"
   style="padding-left: 0px; margin-left: 0px"><i class="icon-feather-edit"></i></a>
<a href="{{ route('members.destroy', $member->id) }}" role="button" class="btn"
   style="padding-left: 0px; margin-left: 0px" onclick="event
        .preventDefault();
        document.getElementById('delete-form-{{ $member->id }}').submit();"><i class="icon-feather-trash"></i></a>
<form id="delete-form-{{ $member->id }}"
      action="{{ route('members.destroy', $member->id) }}" method="POST"
      style="display: none;">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>
