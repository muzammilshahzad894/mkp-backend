@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('New blog post') }}
    </h2>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">{{ __('Create post') }}</h2>
                    <p class="mt-1 text-sm text-gray-600">{{ __('Add a title, content, and optional excerpt and slug.') }}</p>
                </header>

                @include('blog.partials.blog-form', [
                    'action' => route('blogs.store'),
                    'method' => 'POST',
                    'submitLabel' => __('Create post'),
                ])
            </div>
        </div>
    </div>
@endsection
