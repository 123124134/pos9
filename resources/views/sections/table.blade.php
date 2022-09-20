<div class="col-md-4 col-sm-4">
    @if (count($checked) > 1)
        <a href="#" class="btn btn-outline btn-sm" wire:click.prevent="ConfirmBulkDeleted">
            ( {{ count($checked) }} Row Selected to <b>Delete<b>)
        </a>
    @endif
</div>


<table class="table" width="100%">
    <thead>
        <tr>
            <th><input class="h-5 w-5" type="checkbox" wire:model="selectAll"></th>
            <th>Section Name</th>
            <th>Section Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

        @forelse ($sections as $section)
            <tr>
                <td><input value="{{ $section->id }}" class="h-5 w-5" wire:model="checked" type="checkbox"></td>
                <td>{{ $section->section_name }}</td>
                <td>{{ $section->status == 1 ? 'Enable' : 'Disabled' }}</td>
                <td>
                    <div class="btn-group">
                        <a href="#editSection" data-toggle="modal" wire:click.prevent="editSection({{ $section->id }})"
                            class="btn btn-outline-info btn-rounded"><i class="fas fa-edit"></i></a>
                        @if (count($checked) < 2)
                            <a href="#"
                                wire:click.prevent="ConfirmDelete({{ $section->id }}, '{{ $section->section_name }}')"
                                class="btn btn-outline-danger btn-rounded"><i class="fas fa-trash"></i>
                            </a>
                        @endif
                    </div>
                </td>
            </tr>
            @include('sections.edit')
        @empty
        @endforelse

    </tbody>
</table>
