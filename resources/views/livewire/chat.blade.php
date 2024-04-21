<div>
    @if($showChat)
    <div class="mt-11 pb-15 px-16 xl:px-20 h-[72vh] lg:h-[78vh] overflow-y-auto overflow-x-hidden">
        <div wire:poll.visible class="relative">
            @php($date='')
            @foreach($models as $row)
                @if(date('Y-m-d',strtotime($date))!=date('Y-m-d',strtotime($row->created_at)))
                    <span class="badge badge-neutral my-4 mx-80">{{ date('d/m/Y',strtotime($row->created_at)) }}</span>
                @endif

                <div id="message_{{ $row->id }}" wire:key='{{ $row->id }}' class="chat {{ $row->from_user_id==auth()->id() ? 'chat-end' : 'chat-start' }}" x-init='document.getElementById("message_last").scrollIntoView({ behavior: "smooth", block: "end", inline: "nearest" })'>
                    <div class="chat-header">
                    {{ optional($row->sender)->name }}
                    <time class="text-xs opacity-50">{{ date('H:i',strtotime($row->created_at)) }}</time>
                    </div>
                    <div class="chat-bubble">{{ $row->content }}</div>
                    <div class="chat-footer opacity-50">
                    Delivered
                    </div>
                </div>
             
                @php($date=$row->created_at)
            @endforeach
            <div id="message_last">&nbsp;</div>
        </div>
    </div>
    
    <form class="p-2 ms-0 fixed bottom-0 bg-gray-700 md:w-[66vw] lg:w-[75vw] xl:w-[77vw]" wire:submit.prevent='send'>
        <div class="join">
            <input class="input input-bordered join-item md:w-[58vw] lg:w-[69vw] xl:w-[71vw]" placeholder="Type a message" wire:model='message' autofocus />
            <button type="submit" class="btn join-item rounded-r-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                </svg>
            </button>
          </div>
    </form>
    @endif
</div>