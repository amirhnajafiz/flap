<div class="my-2 p-2 text-dark">
    <div class="card">
        <div class="card-header">
            {{ $title }}
        </div>
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <p>
                    {{ $content }}
                </p>
                <footer class="blockquote-footer mt-1">
                    <small class="d-inline-block">
                        {{ $more }}
                    </small>
                    <small class="float-end">
                        <a href="{{ $link }}">
                            View more
                        </a>
                    </small>
                </footer>
            </blockquote>
        </div>
    </div>
</div>
