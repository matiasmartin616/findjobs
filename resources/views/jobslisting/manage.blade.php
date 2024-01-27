<x-layout>
    <x-card class="p-10">
      <header>
        <h1 class="text-3xl text-center font-bold my-6 uppercase">
          Manage Gigs
        </h1>
        <div class="flex my-3">
            <a href="/joblisting/create" class="bg-black text-white py-2 px-5">Add job offer</a>
        </div>
      </header>

      <table class="w-full table-auto rounded-sm">
        <tbody>
          @unless($joblistings->isEmpty())
          @foreach($joblistings as $joblisting)
          <tr class="border-gray-300">
            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
              <a href="/joblisting/{{$joblisting->id}}"> {{$joblisting->title}} </a>
            </td>
            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
              <a href="/joblisting/{{$joblisting->id}}/edit" class="text-blue-400 px-6 py-2 rounded-xl"><i
                  class="fa-solid fa-pen-to-square"></i>
                Edit</a>
            </td>
            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
              <form method="POST" action="/joblisting/{{$joblisting->id}}">
                @csrf
                @method('DELETE')
                <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
          @else
          <tr class="border-gray-300">
            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
              <p class="text-center">No job offers to manage</p>
            </td>
          </tr>
          @endunless

        </tbody>
      </table>
    </x-card>
  </x-layout>

