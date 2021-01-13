                    <div style="padding-bottom: 20px; padding-left: 10px;">
					<br>

						@foreach($tender->downloads as $download)
								<!-- <a href="{{('/storage'.$download->url)}}" target="_blank"><img src={{ asset('images/download.svg') }} style="height: 2%;width: 2%;margin-right: 8px">{{$download->title}}</a><br> 
                                <a href="{{asset ($download->url)}}" target="_blank"><img src={{ asset('images/download.svg') }} style="height: 2%;width: 2%;margin-right: 8px">{{$download->title}}</a><br>
                                 -->
								 <div class="d-flex justify-content-between">
								 <a href="{{ route('downloadcount',$download->id) }}" target="_blank"><img src={{ asset('images/download.svg') }} style="height: 2%;width: 2%;margin-right: 8px">{{$download->title}}</a><br>
								 @if($download->download_count == null) 	
										<div>Count=0</div>
								
								@else
										<div>Count={{$download->download_count}}</div>
									
								@endif
								</div>

								@endforeach

								
					</div>


