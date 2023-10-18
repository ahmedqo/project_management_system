<main>
    <div style="margin: 20px 0; text-align: center">
        <h4>{{ __('Hello') }} {{ $data['name'] }}</h4>
        <p>
            {{ __('To reset your password, please click on this link:') }}
        </p>
    </div>
    <a href="{{ route('views.reset', $data['token']) }}"
        style="
            border: unset;
            display: block;
            font-size: 1.125rem;
            border-radius: 0.5rem;
            font-weight: 500;
            color: #FFFFFF;
            background: #dc2626;
            padding: 10px 20px;
            width: max-content;
            text-align: center;
            cursor: pointer;
            margin: auto;
        ">
        {{ __('Reset') }}
    </a>
</main>
