@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 style="color: #000000;">User Settings</h2>
                    </div>

                    <div class="card-body">
                        <select class="browser-default custom-select" name="setting_country_select">
                            @foreach($settings->Countries as $country)
                                <option id="{{ $country->CountryID }}">{{ $country->CountryName }}</option>
                            @endforeach
                        </select>
                        @foreach($settings->Categories as $category)
                            <div class="form-check">
                                <input type="checkbox"
                                       class="form-check-input"
                                       name="chbx_category_{{ $category->CategoryID }}"
                                       id="{{ $category->CategoryID }}"
                                >
                                <label class="form-check-label" for="{{ $category->CategoryID }}" style="color: #000000;">
                                    {{ $category->CategoryName }}
                                </label>
                            </div>
                        @endforeach
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
