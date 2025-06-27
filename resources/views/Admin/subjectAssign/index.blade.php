{{-- @extends('Admin.layouts.Master')
@section('content')
    <div class="app-main" id="main">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin row -->
            <div class="row">
                @foreach ($data as $d)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-statistics">
                                <div class="card-header">
                                    <div class="card-heading">
                                        <h4 class="card-title">{{ $d->name }}</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @foreach ($subjects as $sub)
                                        @if ($sub->subCategories()->count() ==0)
                                            <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                            <label class="form-check-label" for="inlineCheckbox1">{{ $sub->name }}</label>
                                        </div>
                                        @elseif($sub->subCategories()->count() >0)
                                        @foreach($sub->subCategories)
                                        <div class="col-md-12 col-12 selects-contant">
                                        <div class="card card-statistics Multi-sel">



                                                        @elseif($sub->subCategories()->count() >0)
                                                         <select class="js-basic-multiple form-control select2-hidden-accessible" name="states[]" multiple="" data-select2-id="4" tabindex="-1" aria-hidden="true">
                                                        <optgroup label="{{ $sub->name }}" data-select2-id="8">
                                                            @foreach($sub->subCategories as $category)
                                                            <option value="AK" data-select2-id="9">{{ $category->name }}</option>
                                                           @endforeach
                                                        </optgroup>
                                                    </select>



                                    </div>
                                        @endforeach

                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    @endsection
 --}}

 @extends('Admin.layouts.Master')

@section('content')
<div class="app-main" id="main">
    <div class="container-fluid">
        <form action="{{ route('admin.subjectAssign.store') }}" method="POST">
            @csrf

            <div class="row">
                @foreach ($data as $class)
                    <div class="col-md-12 mb-4">
                        <div class="card card-statistics">
                            <div class="card-header">
                                <h4 class="card-title">{{ $class->name }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    {{-- Subjects without subcategories – show as checkboxes --}}
@foreach ($subjects->filter(fn($s) => is_null($s->parent_id)) as $subject)
    <div class="col-md-3">
        <div class="form-check">
            <input class="form-check-input"
                type="checkbox"
                name="subjects[{{ $class->id }}][]"
                id="subject_{{ $class->id }}_{{ $subject->id }}"
                value="{{ $subject->id }}"
                {{ $class->subjects->contains($subject->id) ? 'checked' : '' }}>
            <label class="form-check-label" for="subject_{{ $class->id }}_{{ $subject->id }}">
                {{ $subject->name }}
            </label>
        </div>
    </div>
@endforeach





                                    {{-- Subjects with subcategories – show as multiselect with optgroup --}}
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group mb-0">
                                            <label><strong>Grouped Sub-Subjects (Multi-Select)</strong></label>
                                           <select class="js-basic-multiple form-control"
    name="subjects[{{ $class->id }}][]"
    multiple="multiple">
    @foreach ($subjects->where('subCategories', '!=', collect([])) as $main)
        @if ($main->subCategories->count())
            <optgroup label="{{ $main->name }}">
                @foreach ($main->subCategories as $child)
                    <option value="{{ $child->id }}"
                        {{ $class->subjects->contains($child->id) ? 'selected' : '' }}>
                        {{ $child->name }}
                    </option>
                @endforeach
            </optgroup>
        @endif
    @endforeach
</select>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Save All Assignments</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
