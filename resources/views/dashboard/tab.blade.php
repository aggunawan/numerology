<ul class="flex flex-row" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
    <li class="w-1/2 lg:w-auto" role="presentation">
        <button class="{{ $tab == 'summary' ? 'active' : null }} flex flex-row py-2 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg hover:text-blue-600 hover:shadow-md hover:bg-white hover:rounded font-bold ml-auto" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="{{ $tab == 'summary' ? 'true' : null }}">
            <svg data-tabs-target="#profile" type="button" aria-controls="profile" aria-selected="{{ $tab == 'summary' ? 'true' : null }}" class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
            </svg>
            Summary
        </button>
    </li>
    @auth
    <li class="w-1/2 lg:w-auto" role="presentation">
        <button id="coaching" class="{{ $tab == 'coaching' ? 'active' : null }} flex flex-row py-2 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg hover:text-blue-600 hover:shadow-md hover:bg-white hover:rounded font-bold ml-auto" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="{{ $tab == 'coaching' ? 'true' : null }}">
            <svg data-tabs-target="#profile" type="button" aria-controls="profile" aria-selected="{{ $tab == 'coaching' ? 'true' : null }}" class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
            </svg>
            Coaching
        </button>
    <input id="user-name" type="hidden" value="{{Auth::user()->name}}">
    </li>
    @endauth
    @if(!$hideYear)
    <li class="w-1/2 lg:w-auto" role="presentation">
        <button class="{{ $tab == 'year' ? 'active' : null }} flex flex-row py-2 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg hover:text-blue-600 hover:shadow-md hover:bg-white hover:rounded font-bold" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="{{ $tab == 'year' ? 'true' : null }}">
            <svg data-tabs-target="#dashboard" aria-controls="dashboard" aria-selected="{{ $tab == 'year' ? 'true' : null }}" class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            Year
        </button>
    </li>
    @endif
</ul>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var name = $('#user-name').val();
        $("#coaching").click(function() {
            $.ajax({
                url: "/api/getToken",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    location.href = "http://localhost:3000/?token=" + res.data.token + "&name=" + name
                }
            });
        });
    });
</script>