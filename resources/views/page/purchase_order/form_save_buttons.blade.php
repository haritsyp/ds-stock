@if(isset($saveAction['active']) && !is_null($saveAction['active']['value']))
    <div id="saveActions" class="form-group">

        <input type="hidden" name="save_action" value="{{ $saveAction['active']['value'] }}">
        @if(!empty($saveAction['options']))
            <div class="btn-group" role="group">
                @endif

                <button type="submit" class="btn btn-default">
                    <span data-value="{{ $saveAction['active']['value'] }}">Save</span>
                </button>

                <div class="btn-group" role="group">
                    @if(!empty($saveAction['options']))
                        <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                class="caret"></span><span class="sr-only">&#x25BC;</span></button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            @foreach( $saveAction['options'] as $value => $label)
                                <a class="dropdown-item" href="javascript:void(0);"
                                   data-value="{{ $value }}">{{ $label }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>

                @if(!empty($saveAction['options']))
            </div>
        @endif
    </div>
@endif

