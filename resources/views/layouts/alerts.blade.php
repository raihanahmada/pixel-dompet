@if(session('success'))
    <div class="alert-pixel success">
        <div class="icon">✨</div>
        <div class="message">
            <strong>SUCCESS!</strong><br>
            {{ session('success') }}
        </div>
    </div>
@endif

@if(session('error'))
    <div class="alert-pixel error">
        <div class="icon">💀</div>
        <div class="message">
            <strong>FAILED!</strong><br>
            {{ session('error') }}
        </div>
    </div>
@endif

@if($errors->any())
    <div class="alert-pixel error">
        <div class="icon">⚠️</div>
        <div class="message">
            <strong>VALIDATION ERROR!</strong>
            <ul style="margin: 5px 0 0 0; padding-left: 20px; font-size: 14px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<style>
    .alert-pixel {
        display: flex;
        align-items: center;
        padding: 15px;
        margin-bottom: 20px;
        border: 4px solid #000;
        font-family: 'VT323', monospace;
        box-shadow: 4px 4px 0px #000;
        animation: press-start 0.5s infinite alternate;
    }

    .alert-pixel.success {
        background-color: #d4edda;
        color: #155724;
        border-color: #155724;
    }

    .alert-pixel.error {
        background-color: #f8d7da;
        color: #721c24;
        border-color: #721c24;
    }

    .alert-pixel .icon {
        font-size: 30px;
        margin-right: 15px;
    }

    .alert-pixel .message {
        font-size: 18px;
        line-height: 1.2;
    }

    @keyframes press-start {
        from { transform: translateY(0); }
        to { transform: translateY(-2px); }
    }
</style>
