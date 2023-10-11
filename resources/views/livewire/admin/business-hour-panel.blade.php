<div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Day</th>
                    <th>
                        <div class="d-flex justify-content-between">
                            Business Hour
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-success btn-air-success mx-2"
                                    wire:click="save">Save</button>
                                @livewire('business-hour-exceptions')
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($days as $day => $data)
                    <tr>
                        <td><b>{{ strtoupper($data['name']) }}</b></td>

                        <td>
                            @if ($days[$day]['open'] ?? false)
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
                                                            wire:click="add_interval('{{ $day }}')"><i
                                                                class="fa fa-plus"></i></button>
                                                        <select wire:model="days.{{ $day }}.open"
                                                            class="form-control mx-1" class="form-control">
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
                                                                    <span class="input-group-text">Hour</span>
                                                                    <input type="number" class="form-control"
                                                                        min="0" max="24"
                                                                        wire:model="days.{{ $day }}.intervals.{{ $index }}.start.hour">
                                                                </div>
                                                                @error("days.{{ $day }}.intervals.{{ $index }}.start.hour")
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-text">Min</span>
                                                                    <input type="number" class="form-control"
                                                                        min="0" max="24"
                                                                        wire:model="days.{{ $day }}.intervals.{{ $index }}.start.minute">
                                                                </div>
                                                                @error("days.{{ $day }}.intervals.{{ $index }}.start.minute")
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-text">Hour</span>
                                                                    <input type="number" class="form-control"
                                                                        min="0" max="24"
                                                                        wire:model="days.{{ $day }}.intervals.{{ $index }}.end.hour">
                                                                </div>
                                                                @error("days.{{ $day }}.intervals.{{ $index }}.end.hour")
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-text">Min</span>
                                                                    <input type="number" class="form-control"
                                                                        min="0" max="24"
                                                                        wire:model="days.{{ $day }}.intervals.{{ $index }}.end.minute">
                                                                </div>
                                                                @error("days.{{ $day }}.intervals.{{ $index }}.end.minute")
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button"
                                                            class="btn btn-danger btn-air-danger btn-sm"
                                                            wire:click="remove_interval('{{ $day }}',{{ $index }})"><i
                                                                class="fa fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <select wire:model="days.{{ $day }}.open" class="form-control"
                                    class="form-control">
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
</div>
