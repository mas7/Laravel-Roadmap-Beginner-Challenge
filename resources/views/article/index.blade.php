<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @auth
                        <div class="px-5 py-4 flex justify-end items-center">
                            <a class="bg-purple-500 px-4 py-2 rounded text-white"
                                href="{{ route('article.create') }}">Add</a>
                        </div>
                    @endauth
                    @forelse ($articles as $article)
                        <div class="mb-4">
                            {{-- Article Header --}}
                            <div>
                                <div>
                                    <a href="{{ route('article.show', $article) }}">
                                        {{-- Article Header / Image --}}
                                        <div>
                                            <img src="{{ asset($article->image) }}"
                                                alt="{{ $article->title }} image">
                                        </div>
                                        {{-- Article Header / Title & Date --}}
                                        <div>
                                            <h1 class="text-xl">{{ $article->title }}</h1>
                                            <p class="text-sm">{{ $article->created_at }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            {{-- Article Body --}}
                            <div>
                                {{-- Article Body / Category & Text --}}
                                <div>
                                    <div>
                                        <h4 class='text-sm '>Category:
                                            <a class="underline text-sky-500"
                                                href="{{ route('category.show', $article->category) }}">
                                                {{ $article->category->title }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div>
                                        <p>
                                            {{ $article->text }}
                                        </p>
                                    </div>
                                </div>
                                {{-- Article Body / Tags --}}
                                <div>
                                    tags:
                                    @if ($article->tags)
                                        @foreach ($article->tags as $tag)
                                            <span>
                                                <a class="underline text-sky-500"
                                                    href="{{ route('tag.show', $tag) }}">
                                                    {{ $tag->title }}
                                                </a>
                                                @if (!$loop->last)
                                                    ,
                                                @endif
                                            </span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <h3>No articles.</h3>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
