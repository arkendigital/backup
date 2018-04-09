@extends("layouts.master")

@section("content")
<div class="website-container">
    <div class="website-container-content view-section">
        <h2>Search results</h2>

        @if (! $results->pages->isEmpty() || ! $results->jobs->isEmpty() || ! $results->exams->isEmpty() || $results->discussions->isEmpty())

            <ul class="tab-nav">
                @unless($results->pages->isEmpty())
                    <li><a href="javascript:void(0)" data-tab="pages">Pages</a></li>
                @endunless          
                @unless($results->jobs->isEmpty())
                    <li><a href="javascript:void(0)" data-tab="jobs">Jobs</a></li>
                @endunless       
                @unless($results->discussions->isEmpty())
                    <li><a href="javascript:void(0)" data-tab="discussions">Discussions</a></li>
                @endunless         
                @unless($results->exams->isEmpty())
                    <li><a href="javascript:void(0)" data-tab="exams">Exams</a></li>
                @endunless
            </ul>
                
            <div class="tab-body">
                @unless($results->pages->isEmpty())
                <div class="tab-content tab-pages" id="pages">
                    <h3>Pages</h3>

                    @foreach ($results->pages as $page)
                        <div class="search__item">
                            <h4><a href="/{{$page->slug}}">{{ $page->name }}</a></h4>     
                        </div>
                    @endforeach
                </div>
                @endunless

                @unless($results->jobs->isEmpty())
                <div class="tab-content" id="jobs">
                    <h3>Jobs</h3>

                    @foreach ($results->jobs as $job)
                        <div class="search__item">
                            <h4><a href="{{ route('job.show', $job) }}">{{ $job->title }}</a></h4>
                            @if($job->excerpt) <p class="search__excerpt">{{ $job->excerpt }}</p> @endif  
                            <p class="search__date">{{ $job->created_at->format('j M Y') }}</p>           
                        </div>
                    @endforeach
                </div>
                @endunless

                @unless($results->exams->isEmpty())
                <div class="tab-content" id="exams">
                    <h3>Exam Categories</h3>

                    @foreach ($results->exams as $exam)
                        <div class="search__item">
                    
                            <h4><a href="{{ route('exam.show', $exam) }}">{{ $exam->name }}</a></h4>
                            
                            @unless($exam->modules->isEmpty())
                                <p class="search__excerpt">Modules: 
                                @foreach ($exam->modules as $module)
                                    @if(! $loop->last)
                                        {{ $module->name }}, 
                                    @else
                                        {{ $module->name }}
                                    @endif                        
                                @endforeach
                                </p>
                            @endunless
                        </div>            
                    @endforeach
                </div>
                @endunless


                @unless($results->discussions->isEmpty())
                <div class="tab-content" id="discussions">                
                    <h3>Discussions</h3>

                    @foreach ($results->discussions as $discussion)
                        <div class="search__item">                
                            <h4><a href="{{ route('discussion.view', [ $discussion->category, $discussion->slug ]) }}">
                                {{ $discussion->name }}
                            </a></h4>
                            {{-- <p class="search__excerpt">{{ $discussion->excerpt }}</p> --}}
                            <p class="search__date">{{ $discussion->created_at->format('j M Y') }}</p>
                        </div>
                    @endforeach
                </div>
                @endunless
            </div>

        @else
            <form action="{{route('search') }}" method="" class="search-form search-form--full">
                <p>No results were found, please use the search form below to adjust your search terms.</p>

                <h5>Search</h5> <br>
                <input type="text" name="q" placeholder="Search" value="{{ old('q') }}">
                <button type="submit"><img src="/images/icons/search.png" alt="" title=""></button>            
            </form>
        @endif
    </div>
</div>


@endsection

@push('scripts-after')
<script>
    $('.tab-nav li a').click(function() {
      var box = $(this).data('tab');
      $('.tab-nav li a').removeClass('current');
      $(this).addClass('current');
      
      $('.tab-content').addClass('tab-content-hidden');
      $('#' + box).removeClass('tab-content-hidden');
    });

    $('.tab-nav li a:first').click();
</script>
@endpush