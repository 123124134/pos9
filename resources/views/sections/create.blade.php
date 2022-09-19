<style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }
    
    .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
    }
    
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    input:checked + .slider {
      background-color: #2196F3;
    }
    
    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }
    
    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }
    
    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }
    
    .slider.round:before {
      border-radius: 50%;
    }
    </style>
    
<div class="modal fade" id="addSection" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <h3 class="modal-title">Add New Section</h3>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="store" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @forelse ($addMore as $more)
                        <div class="form-row">
                            <div class="col">
                                <label for="">Section Name</label>
                                <input type="text" name="section_name" id="section_name" class="form-ontrol"
                                    autocomplete="off">
                                @error('section_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-1" data-toggle=" tooltip" data-placement="top" title="status">
                                <label class="switch">
                                    <input type="checkbox">
                                    <span class="slider"></span>
                                  </label>
                                  
                            </div>

                            <div class="col-sm-2">

                                @if ($loop->index == 0)
                                    <button class="btn btn-success " style="margin-top:px !important" wire:igore
                                        wire:click.prevent="AddMore">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                @endif
                                @if ($loop->index > 0)
                                    <button class="btn btn-danger" wire:igore
                                        wire:click.prevent="Remove({{ $loop->index }})">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                @endif
                            </div>
                        </div>
                    @empty
                    @endforelse
                    <div class="modal-footer">
                        <button type="submit" class="btn-primary btn-block">Create Section</button>

                        <button type="button" class="btn-danger btn-block" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
