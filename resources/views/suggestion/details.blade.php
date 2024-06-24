<x-app-layout>
    <section class="page-section portfolio" id="portfolio">
        <div class="container-edit">
            <h2>Suggestions & Questions</h2>
            <p>Name: {{ $suggestion->name }}</p>
            <p>Email: {{ $suggestion->email }}</p>
            <p>Phone: {{ $suggestion->phone }}</p>
            <p>Message: {{ $suggestion->message }}</p>
            <a href="{{ route('suggestionlist') }}" class="btn btn-primary">Back</a> 
        </div>
    </section>
</x-app-layout>