<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Queue & Jobs</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-200">

    <div class="mx-auto max-w-screen-xl px-4 py-16 my-6">
        <div class="grid grid-cols lg:grid-cols-3 gap-2 mb-6">
            <div class="col-span-2 bg-white p-4 shadow rounded-md">
                <form action="{{url('send-mail')}}" method="post">
                    @csrf
                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="email">Mail To</label>
                        <input
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            id="email" placeholder="name@flowbite.com" type="email" name="mail_to" />
                        @error('mail_to')<small class="text-red-600 font-medium">{{$message}}</small>@enderror
                    </div>
                    <div class="mb-5">
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="subject">Subject</label>
                        <input
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            id="subject" placeholder="Subject..." type="text" name="subject" />
                        @error('subject')<small class="text-red-600 font-medium">{{$message}}</small>@enderror
                    </div>
                    <div class="mb-5">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Message</label>
                        <textarea
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                            id="message" rows="4" placeholder="Leave a message..." name="message"></textarea>
                        @error('message')<small class="text-red-600 font-medium">{{$message}}</small>@enderror
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                        Send Message
                    </button>
                </form>
            </div>
            <div class="col-span-1 bg-white border p-4 shadow rounded-md">
                <p class="bg-blue-100 px-2 py-1 mb-3 text-center rounded-md text-blue-700 font-semibold">
                    .env
                </p>
                <p class="bg-gray-100 px-3 py-3 mb-3 rounded-md text-gray-600 font-semibold">
                    MAIL_MAILER=smtp<br />
                    MAIL_HOST=smtp.gmail.com<br />
                    MAIL_PORT=465<br />
                    MAIL_USERNAME="mail@gmail.com"<br />
                    MAIL_PASSWORD="xxxx xxxx xxxx xxxx"<br />
                    MAIL_ENCRYPTION=tls<br />
                    MAIL_FROM_ADDRESS="mail@gmail.com"<br />
                    MAIL_FROM_NAME="Your Name"<br />
                </p>

                <div class="text-center">
                    <button class="text-blue-700 font-semibold" data-modal-target="mail-password-modal"
                        data-modal-toggle="mail-password-modal" type="button">
                        How to create a mail password?
                    </button>
                </div>

                <div id="mail-password-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <div class="relative bg-white rounded-lg shadow">
                            <div class="p-4 md:p-5 space-y-4">
                                <ul class="text-gray-700">
                                    <li class="border-b py-2">
                                        Login to your gmail account e.g. myaccount.google.com
                                    </li>
                                    <li class="border-b py-2">
                                        Go to Security setting and Enable 2 factor (step) authentication
                                    </li>
                                    <li class="border-b py-2">
                                        After enabling this you can see app passwords option. Click
                                        <a class="text-blue-700 font-medium underline"
                                            href="https://myaccount.google.com/apppasswords" target="_blank">
                                            here</a>.
                                    </li>
                                    <li class="border-b py-2">
                                        And then, from Your app passwords tab select Other option and put your app
                                        name and click GENERATE button to get new app password.
                                    </li>
                                    <li>
                                        Finally copy the 16 digit of password and click done. Now use this password
                                        instead of email
                                        password to send mail via your app.
                                    </li>
                                </ul>
                            </div>
                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                                <button data-modal-hide="mail-password-modal" type="button"
                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="bg-blue-50 p-4 shadow rounded-md mb-6">
            <div class="flex justify-between items-center">
                <div class="mb-4 text-sm uppercase font-bold text-blue-700">
                    Jobs
                </div>
                <div
                    class="mb-4 text-sm font-medium bg-blue-200 border border-blue-700 text-blue-900 px-3 py-1 rounded-md flex items-center">
                    php artisan queue:work
                </div>
            </div>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-white uppercase bg-blue-500">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Queue
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Payload
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Attempts
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Reserved At
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Available At
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Created At
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4">{{$job->queue}}</td>
                            <td class="px-6 py-4">{{$job->payload}}</td>
                            <td class="px-6 py-4">{{$job->attempts}}</td>
                            <td class="px-6 py-4">{{$job->reserved_at}}</td>
                            <td class="px-6 py-4">{{$job->available_at}}</td>
                            <td class="px-6 py-4">{{$job->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-red-50 p-4 shadow rounded-md mb-6">
            <div class="flex justify-between items-center">
                <div class="mb-4 text-sm uppercase font-bold text-red-700">
                    Failed Jobs
                </div>
                <div
                    class="mb-4 text-sm font-medium bg-red-200 border border-red-700 text-red-900 px-3 py-1 rounded-md flex items-center">
                    php artisan queue:retry all
                </div>
            </div>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-white uppercase bg-red-500">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                UUID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Connection
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Queue
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Payload
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Exception
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Failed At
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($failedJobs as $failedJob)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4">{{$failedJob->uuid}}</td>
                            <td class="px-6 py-4">{{$failedJob->connection}}</td>
                            <td class="px-6 py-4">{{$failedJob->queue}}</td>
                            <td class="px-6 py-4">{{$failedJob->payload}}</td>
                            <td class="px-6 py-4">{{$failedJob->exception}}</td>
                            <td class="px-6 py-4">{{$failedJob->failed_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>