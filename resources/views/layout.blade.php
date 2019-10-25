<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logins</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet"></head>
    <body class="font-sans leading-none text-grey-darkest antialiased bg-gray-100">
        <div class="container mx-auto mt-20 px-24">
            <h1 class="mb-8 font-bold text-3xl">Logins</h1>
            <div class="bg-white rounded shadow overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <tr class="text-left font-bold">
                        <th class="px-6 pt-6 pb-4">Time</th>
                        <th class="px-6 pt-6 pb-4">Date</th>
                        <th class="px-6 pt-6 pb-4">Name</th>
                        <th class="px-6 pt-6 pb-4">Email</th>
                    </tr>
                    @if($logins->count())
                    @foreach($logins as $login)
                    <tr class="hover:bg-grey-lightest focus-within:bg-grey-lightest">
                        <td class="border-t">
                            <div class="px-6 py-4 flex items-center focus:text-indigo">
                                {{ $login->created_at->toTimeString() }}
                            </div>
                        </td>
                        <td class="border-t">
                            <div class="px-6 py-4 flex items-center" tabindex="-1">{{ $login->created_at->toDateString() }}</div>
                        </td>
                        <td class="border-t">
                            <div class="px-6 py-4 flex items-center" tabindex="-1">{{ $login->user->name }}</div>
                        </td>
                        <td class="border-t w-px">
                            <div class="px-4 flex items-center" tabindex="-1">
                                {{ $login->user->email }}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td class="border-t px-6 py-4 text-center" colspan="4">No users found.</td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
    </body>
</html>
