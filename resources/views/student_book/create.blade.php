<x-layout>
    <div>
        <nav class="flex" aria-label="Breadcrumb">
            <!-- Breadcrumb code here -->
        </nav>
    </div>

    <section class="m-4 relative">
        <div class="flex justify-between">
            <div>
                <a href="{{ route('student-book.index') }}">
                    <button type="button" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</button>
                </a>
            </div>
            <div>

                <button id="return-button" type="button" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" style="display: none;">
                    Return
                </button>
                </a>
                <button id="renew-button" type="button" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" style="display: none;">
                    Renew
                </button>


                <button id="add-book-button" type="button" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    Add Book
                </button>

            </div>
        </div>

        <!-- Hidden search form -->
        <section id="search-section" class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto p-4" style="display: none;">
            <div class="search-box bg-white p-8 rounded-lg shadow-lg max-w-lg mx-auto w-full relative ">
                <form id="search-form" action="{{ route('book-search') }}" method="GET">
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="search" name="query" autocomplete="off" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="book id" />
                    </div>
                </form>
                <div id="search-results" class="mt-4 max-h-64 overflow-y-auto">
                    <!-- AJAX will populate this div with the search results -->
                </div>
                <button id="close-search-button" type="button" class="mt-4 px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600">Close</button>
            </div>
        </section>

        <!-- Main content -->
        <section>
            <div>
                <h1>Name: {{ $student->name }}</h1>
                <h1>Faculty: {{ $student->faculty->name }}</h1>
                <h1>Phone: {{ $student->phone }}</h1>
                @php
                $today = \Carbon\Carbon::now();
                @endphp
                <h1>{{ \Carbon\Carbon::now()->toDateString() }}</h1>
                <!-- to diplay fine -->

            </div>
            <div>
                <h1>No of Books: 4</h1>
            </div>
        </section>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" data-book-count="{{ $student->books->count() }}">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Book name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Issued At
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Expires AT
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fine
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @if($student->books->isNotEmpty())
                    @foreach($student->books as $index => $book)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-{{ $index }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    data-book-id="{{ $book->id }}" data-student-id="{{ $student->id }}">
                                <label for="checkbox-table-{{ $index }}" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $book->name }}<br>
                        </th>
                        <td class="px-6 py-4">
                            @if($book->pivot->created_at)
                            {{ $book->pivot->created_at->format('Y-m-d') }}
                            @else
                            Not Assigned
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($book->pivot->expiry_date)
                            {{ \Carbon\Carbon::parse($book->pivot->expiry_date)->format('Y-m-d') }}
                            @else
                            Not Set
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @php
                            $a = \Carbon\Carbon::now();
                            $b = \Carbon\Carbon::parse($book->pivot->expiry_date);
                            $c = floor($b->diffInDays($a))*3; // Use floor to ensure integer value
                            @endphp

                            @if($c > 0)
                            <span class="text-red-600">Rs.{{ $c }}</span>
                            @else
                            <span>-</span>
                            @endif


                        </td>
                    </tr>
                    @endforeach

                    @else
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td>No books assigned</td>
                    </tr>
                    @endif
                </tbody>

            </table>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle search section visibility
            document.getElementById('add-book-button').addEventListener('click', function() {
                const searchSection = document.getElementById('search-section');
                searchSection.style.display = searchSection.style.display === 'none' ? 'flex' : 'none';
            });

            document.getElementById('close-search-button').addEventListener('click', function() {
                const searchSection = document.getElementById('search-section');
                searchSection.style.display = 'none';
            });

            // Handle search input and AJAX request
            document.getElementById('search').addEventListener('keyup', function() {
                let query = this.value.trim(); // Trim to remove any accidental spaces
                let searchResultsDiv = document.getElementById('search-results');
                let studentId = document.querySelector('input[name="student_id"]').value; // Get the student_id

                if (query.length > 0) {
                    fetch(`{{ route('book-search') }}?query=${query}&student_id=${studentId}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            searchResultsDiv.innerHTML = data.html;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                } else {
                    // Clear the search results div if the input is empty
                    searchResultsDiv.innerHTML = '';
                }
            });

            // Handle checkbox selection and action buttons
            const selectAllCheckbox = document.getElementById('checkbox-all');
            const rowCheckboxes = document.querySelectorAll('tbody input[type="checkbox"]');
            const actionButtons = document.querySelectorAll('#return-button, #renew-button');

            function toggleAllCheckboxes(checked) {
                rowCheckboxes.forEach(checkbox => {
                    checkbox.checked = checked;
                });
                toggleActionButtons();
            }

            function toggleActionButtons() {
                // Check if any checkboxes are selected
                const anyChecked = Array.from(rowCheckboxes).some(checkbox => checkbox.checked);
                actionButtons.forEach(button => {
                    button.style.display = anyChecked ? 'inline-block' : 'none';
                });

                if (anyChecked) {
                    const studentId = document.querySelector('input[name="student_id"]').value; // Get student_id

                    // Update buttons to call the respective route with student_id and all selected book_ids
                    document.getElementById('renew-button').onclick = function() {
                        const selectedBooks = Array.from(rowCheckboxes)
                            .filter(checkbox => checkbox.checked)
                            .map(checkbox => checkbox.getAttribute('data-book-id'));
                        if (selectedBooks.length > 0) {
                            window.location.href = `/student-book/renew/${studentId}?books=${selectedBooks.join(',')}`;
                        }
                    };

                    document.getElementById('return-button').onclick = function() {
                        const selectedBooks = Array.from(rowCheckboxes)
                            .filter(checkbox => checkbox.checked)
                            .map(checkbox => checkbox.getAttribute('data-book-id'));
                        if (selectedBooks.length > 0) {
                            window.location.href = `/student-book/return/${studentId}?books=${selectedBooks.join(',')}`;
                        }
                    };
                } else {
                    // Clear onclick attributes if no checkboxes are selected
                    document.getElementById('renew-button').onclick = null;
                    document.getElementById('return-button').onclick = null;
                }
            }

            selectAllCheckbox.addEventListener('change', function() {
                toggleAllCheckboxes(this.checked);
            });

            rowCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    const allChecked = Array.from(rowCheckboxes).every(checkbox => checkbox.checked);
                    const noneChecked = Array.from(rowCheckboxes).every(checkbox => !checkbox.checked);

                    selectAllCheckbox.checked = allChecked;
                    selectAllCheckbox.indeterminate = !allChecked && !noneChecked;

                    toggleActionButtons();
                });
            });

            // Initialize the button visibility on page load
            toggleActionButtons();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.querySelector('table[data-book-count]');
            const addButton = document.getElementById('add-book-button');

            if (table) {
                const bookCount = parseInt(table.getAttribute('data-book-count'), 10);

                if (bookCount >= 3) {
                    addButton.style.display = 'none'; // Hide the button
                } else {
                    addButton.style.display = 'inline-block'; // Show the button
                }
            }
        });
    </script>



</x-layout>