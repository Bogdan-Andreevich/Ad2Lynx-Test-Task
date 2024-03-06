<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ad2Lynx</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-8">
<div class="container mx-auto">
    <div class="mb-8">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="{{route('home.create')}}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="endpoint1">
                    Endpoint 1
                </label>
                <input required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="endpoint1" name="endpoint1" type="text" placeholder="Endpoint 1" value="{{old('endpoint1')}}">
                @error('endpoint1')
                <div class="text-red-500" role="alert">{{ e($message) }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="endpoint2">
                    Endpoint 2
                </label>
                <input required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="endpoint2" name="endpoint2" type="text" placeholder="Endpoint 2" value="{{old('endpoint2')}}">
                @error('endpoint2')
                <div class="text-red-500" role="alert">{{ e($message) }}</div>
                @enderror
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Get
                </button>
            </div>
        </form>
    </div>
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <form action="{{ route('home.index') }}">
            @csrf
            <div class="flex justify-between mb-4">

                <div class="flex-1">
                    <input class="border p-2 w-full" name="ad_id" type="text" placeholder="Search..." required>
                </div>

                <button class="bg-blue-500 text-white px-4 py-2 rounded font-bold hover:bg-blue-700" type="submit">
                    Search
                </button>

                <div class="bg-gray-500 text-white px-4 py-2 rounded font-bold hover:bg-gray-700" type="submit" style="margin-left: 10px;">
                    <a href="{{ route('home.index', ['refresh' => 1]) }}">Refresh</a>
                </div>

            </div>
        </form>
        <table class="table-auto w-full mb-4">
            <thead>
            <tr>
                <th class="px-4 py-2">ad_id</th>
                <th class="px-4 py-2">impressions</th>
                <th class="px-4 py-2">clicks</th>
                <th class="px-4 py-2">unique_clicks</th>
                <th class="px-4 py-2">leads</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ads as $ad)
                <tr>
                    <td class="border px-4 py-2">{{ e($ad->ad_id) }}</td>
                    <td class="border px-4 py-2">{{ e($ad->impressions) }}</td>
                    <td class="border px-4 py-2">{{ e($ad->clicks) }}</td>
                    <td class="border px-4 py-2">{{ e($ad->unique_clicks) }}</td>
                    <td class="border px-4 py-2">{{ e($ad->leads) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
