<style>
    t-row {
        transition: 2s;
    }
</style>
<x-layout>
    
    <section>
        <div class="mt-4">
         

            <div>
                <form id="search-form" class="max-w-md mx-auto " action="{{ route('test-search') }}" method="GET">
               

                    <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                  

                        <input type="search" id="search" name="query" autocomplete="off" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Student name or phone" />
                    </div>
                    <label for="" class="italic ">To view the details about student.</label>
                </form>

                <div id="search-results" class="mt-4">
                    <!-- START SEARCH RESULTS -->
                    @if(isset($students))
                    @if($students->isNotEmpty())
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Student name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Father name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Phone
                                    </th>

                                </tr>
                            </thead>
                            @foreach($students as $student)

                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 t-row hover:bg-gray-100 cursor-pointer">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <a href="{{ route('student_book.create', $student->id) }}">
                                            {{ $student->name }}

                                        </a>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $student->father_name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $student->phone }}
                                    </td>

                                </tr>

                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    </ul>
                    @else
                    <p>No students found.</p>
                    @endif
                    @endif
                    <!-- END SEARCH RESULTS -->
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('input', function() {
                var query = $(this).val();

                if (query.length > 0) {
                    $.ajax({
                        url: "{{ route('test-search') }}",
                        method: 'GET',
                        data: {
                            query: query
                         

                        },
                        success: function(response) {
                            $('#search-results').html(response.html);
                        }
                    });
                } else {
                    $('#search-results').empty();
                }
            });
        });
    </script>
</x-layout>