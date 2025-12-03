<div class="card direct-chat direct-chat-warning mb-4">
    <div class="card-header">
        <h3 class="card-title">Direct Chat</h3>
    </div>

    <div class="card-body">
        <div class="direct-chat-messages">

            <div class="direct-chat-msg">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-start">System Bot</span>
                </div>
                <div class="direct-chat-text">
                    Selamat datang di Dashboard RS Hewan Pintar.
                </div>
            </div>

            <div class="direct-chat-msg end">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-end">{{ Auth::user()->nama ?? 'User' }}</span>
                </div>
                <div class="direct-chat-text">
                    Terima kasih. Saya siap bekerja hari ini!
                </div>
            </div>

        </div>
    </div>
</div>
