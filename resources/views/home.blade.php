@extends('layouts.home')

@section('title', 'URL Shortener')

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
    <script>
        new ClipboardJS('.btn', {
            text: function(trigger) {
                return trigger.getAttribute('aria-label');
            }
        });
    </script>
@endsection
