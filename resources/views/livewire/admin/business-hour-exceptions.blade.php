<div>
    <button type="button" class="btn btn-secondary btn-air-secondary mx-2"
        wire:click="$toggle('exception_toggle')">Exceptions</button>
    @if ($exception_toggle)
        <div class="card"
            style="position: fixed;top: 10vh;right: 10vw;bottom: 0;left: 10vw;z-index: 9999;width: 80vw;height: 60vh;overflow:auto">
            <div class="card-header">

                <div class="d-flex justify-content-between">
                    Exceptions
                    <button class="btn btn-success btn-air-success" wire:click="add_exception">
                        Add
                    </button>
                </div>

                @if ($errors->any())
                    <hr>
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="card-body">
                @if (count($exceptions ?? []) > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>
                                        <div class="d-flex justify-content-between">
                                            Business Hour
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-success btn-air-success mx-2"
                                                    wire:click="save">Save</button>

                                            </div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exceptions as $day => $data)
                                    <tr>
                                        <td>
                                            <input type="text" wire:model="exceptions.{{ $day }}.date"
                                                class="form-control">
                                        </td>

                                        <td>
                                            @if ($exceptions[$day]['open'] ?? false)
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Start</th>
                                                                <th>End</th>
                                                                <th>
                                                                    <div class="d-flex justify-content-end">
                                                                        <button type="button"
                                                                            class="btn btn-primary btn-air-primary btn-sm mx-1"
                                                                            wire:click="add_exception_date_interval('{{ $day }}')"><i
                                                                                class="fa fa-plus"></i></button>
                                                                        <button type="button"
                                                                            class="btn btn-danger btn-air-danger btn-sm mx-1"
                                                                            wire:click="remove_exception('{{ $day }}')"><i
                                                                                class="fa fa-trash"></i></button>
                                                                        <select
                                                                            wire:model="exceptions.{{ $day }}.open"
                                                                            class="form-control mx-1"
                                                                            class="form-control">
                                                                            <option value="1">Opened</option>
                                                                            <option value="0">Closed</option>
                                                                        </select>
                                                                    </div>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data['intervals'] as $index => $interval)
                                                                <tr>
                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <div class="input-group">
                                                                                    <span
                                                                                        class="input-group-text">Hour</span>
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        min="0" max="24"
                                                                                        wire:model="exceptions.{{ $day }}.intervals.{{ $index }}.start.hour">
                                                                                </div>
                                                                                @error("exceptions.{{ $day }}.intervals.{{ $index }}.start.hour")
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <div class="input-group">
                                                                                    <span
                                                                                        class="input-group-text">Min</span>
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        min="0" max="24"
                                                                                        wire:model="exceptions.{{ $day }}.intervals.{{ $index }}.start.minute">
                                                                                </div>
                                                                                @error("exceptions.{{ $day }}.intervals.{{ $index }}.start.minute")
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="row">
                                                                            <div class="col-lg-6">
                                                                                <div class="input-group">
                                                                                    <span
                                                                                        class="input-group-text">Hour</span>
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        min="0" max="24"
                                                                                        wire:model="exceptions.{{ $day }}.intervals.{{ $index }}.end.hour">
                                                                                </div>
                                                                                @error("exceptions.{{ $day }}.intervals.{{ $index }}.end.hour")
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                            <div class="col-lg-6">
                                                                                <div class="input-group">
                                                                                    <span
                                                                                        class="input-group-text">Min</span>
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        min="0" max="24"
                                                                                        wire:model="exceptions.{{ $day }}.intervals.{{ $index }}.end.minute">
                                                                                </div>
                                                                                @error("exceptions.{{ $day }}.intervals.{{ $index }}.end.minute")
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button"
                                                                            class="btn btn-danger btn-air-danger btn-sm"
                                                                            wire:click="remove_exception_date_interval('{{ $day }}',{{ $index }})"><i
                                                                                class="fa fa-trash"></i></button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <select wire:model="exceptions.{{ $day }}.open"
                                                    class="form-control" class="form-control">
                                                    <option value="0">Closed</option>
                                                    <option value="1">Opened</option>
                                                </select>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
            <div class="card-footer">
                <button type="button" wire:click="$toggle('exception_toggle')"
                    class="btn btn-danger btn-air-danger mx-3">Close</button>
            </div>
        </div>
    @endif
    @push('livewire_third_party')
        @include('business_hour::layouts.business_hour_exceptions_scripts')
    @endpush
</div>
