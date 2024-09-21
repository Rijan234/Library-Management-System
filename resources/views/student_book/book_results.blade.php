<!-- partials/_book_results.blade.php -->

<div>
    @if($books->isEmpty())
    <p>No books found.</p>
    @else

    <div class="relative overflow-x-auto ">
      
        <table id="myTable" class="w-3/4 m-4 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-600">
 
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 rounded-s-lg border-b border-gray-300 dark:border-gray-600">
                        Book Name
                    </th>
                    <th scope="col" class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">
                        Book ID
                    </th>
                </tr>
            </thead>
            <tbody>

                @foreach($books as $book)
                <tr class="bg-white dark:bg-gray-800 border-b border-gray-300 dark:border-gray-600">

                    <td class="px-6 py-4">
                        <a href="{{ route('book-store', ['book_id' => $book->id, 'student_id' => request()->student_id]) }}">

                            {{ $book->name }}
                        </a>
                    </td>
                    <td class="px-6 py-4">
                        {{ $book->uuid }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>


<script>
    // JavaScript to toggle the visibility of the table
    var toggleButtons = document.querySelectorAll('.toggleButton');
    toggleButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var table = document.getElementById('myTable');
            if (table.style.display === 'none' || table.style.display === '') {
                table.style.display = 'table';
            } else {
                table.style.display = 'none';
            }
        });
    });

    // JavaScript to hide the table when "Cancel" button is clicked
    var hideButtons = document.querySelectorAll('#hideButton');
    hideButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var table = document.getElementById('myTable');
            table.style.display = 'none';
        });
    });
</script>