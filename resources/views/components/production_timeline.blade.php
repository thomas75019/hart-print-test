<h2 class="text-2xl font-bold mt-4 text-center">Production Timeline</h2>
<div class="p-4 max-w-md mx-auto pt-20 flow-root">
    <ul role="list" class="-mb-8">
        @foreach($schedule as $item)
        <li>
            <div class="relative pb-8">
              <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
              <div class="relative flex space-x-3">
                <div>
                    <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                        <?xml version="1.0" ?><!DOCTYPE svg  PUBLIC '-//W3C//DTD SVG 1.1//EN'  'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'><svg height="32px" style="enable-background:new 0 0 32 32;" version="1.1" viewBox="0 0 32 32" width="32px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Layer_1"/><g id="play_x5F_alt"><path d="M16,0C7.164,0,0,7.164,0,16s7.164,16,16,16s16-7.164,16-16S24.836,0,16,0z M10,24V8l16.008,8L10,24z   " style="fill:#4E4E50;"/></g></svg>                                             
                    </span>        
                </div>
                <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                  <div>
                    <p class="text-sm text-gray-500">Start production of Order # {{ $item['order_id'] }} </p>
                  </div>
                  <div class="whitespace-nowrap text-right text-sm text-gray-500">
                    <time datetime="{{ $item['start_time'] }}">{{ $item['start_time'] }}</time>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="relative pb-8">
                @if(!$loop->last)
                    <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>  
                @endif
              <div class="relative flex space-x-3">
                <div>
                  <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                    <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                      <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                    </svg>
                  </span>
                </div>
                <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                  <div>
                    <p class="text-sm text-gray-500">End Production of Order #{{ $item['order_id'] }}</p>
                  </div>
                  <div class="whitespace-nowrap text-right text-sm text-gray-500">
                    <time datetime="{{ $item['end_time'] }}">{{ $item['end_time'] }}</time>
                  </div>
                </div>
              </div>
            </div>
          </li>
        @endforeach
    </ul>
</div>