@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit blog post') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">{{ __('Edit post') }}</h2>
                    <p class="mt-1 text-sm text-gray-600">{{ __('Update the fields below and save your changes.') }}</p>
                </header>

                <x-blog-form
                    :action="route('blogs.update', $blog)"
                    method="PUT"
                    :submit-label="__('Save changes')"
                    :blog="$blog"
                />
            </div>
        </div>
    </div>
@endsection
