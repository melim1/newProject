{{-- ---------------------- Boîte modale d'image ---------------------- --}}
<div id="imageModalBox" class="imageModal">
    <span class="imageModal-close">&times;</span>
    <img class="imageModal-content" id="imageModalBoxSrc">
</div>

{{-- ---------------------- Boîte modale de suppression ---------------------- --}}
<div class="app-modal" data-name="delete">
    <div class="app-modal-container">
        <div class="app-modal-card" data-name="delete" data-modal='0'>
            <div class="app-modal-header">Êtes-vous sûr de vouloir supprimer ceci ?</div>
            <div class="app-modal-body">Vous ne pouvez pas annuler cette action</div>
            <div class="app-modal-footer">
                <a href="javascript:void(0)" class="app-btn cancel">Annuler</a>
                <a href="javascript:void(0)" class="app-btn a-btn-danger delete">Supprimer</a>
            </div>
        </div>
    </div>
</div>

{{-- ---------------------- Boîte modale d'alerte ---------------------- --}}
<div class="app-modal" data-name="alert">
    <div class="app-modal-container">
        <div class="app-modal-card" data-name="alert" data-modal='0'>
            <div class="app-modal-header"></div>
            <div class="app-modal-body"></div>
            <div class="app-modal-footer">
                <a href="javascript:void(0)" class="app-btn cancel">Annuler</a>
            </div>
        </div>
    </div>
</div>

{{-- ---------------------- Boîte modale des paramètres ---------------------- --}}
<div class="app-modal" data-name="settings">
    <div class="app-modal-container">
        <div class="app-modal-card" data-name="settings" data-modal='0'>
            <form id="update-settings" action="{{ route('avatar.update') }}" enctype="multipart/form-data" method="POST">
                @csrf
                {{-- <div class="app-modal-header">Mettez à jour vos paramètres de profil</div> --}}
                <div class="app-modal-body">
                    {{-- Mettre à jour l'avatar du profil --}}
                    <div class="avatar av-l upload-avatar-preview chatify-d-flex"
                    style="background-image: url('{{ Chatify::getUserWithAvatar(Auth::user())->avatar }}');"
                    ></div>
                    <p class="upload-avatar-details"></p>
                    <label class="app-btn a-btn-primary update" style="background-color:{{$messengerColor}}">
                        Télécharger nouveau
                        <input class="upload-avatar chatify-d-none" accept="image/*" name="avatar" type="file" />
                    </label>
                    {{-- Mode sombre/clair  --}}
                    <p class="divider"></p>
                    <p class="app-modal-header">Mode sombre <span class="
                        {{ Auth::user()->dark_mode > 0 ? 'fas' : 'far' }} fa-moon dark-mode-switch"
                         data-mode="{{ Auth::user()->dark_mode > 0 ? 1 : 0 }}"></span></p>
                    {{-- Changer la couleur du messager  --}}
                    <p class="divider"></p>
                    {{-- <p class="app-modal-header">Changer la couleur de {{ config('chatify.name') }}</p> --}}
                    <div class="update-messengerColor">
                    @foreach (config('chatify.colors') as $color)
                        <span style="background-color: {{ $color}}" data-color="{{$color}}" class="color-btn"></span>
                        @if (($loop->index + 1) % 5 == 0)
                            <br/>
                        @endif
                    @endforeach
                    </div>
                </div>
                <div class="app-modal-footer">
                    <a href="javascript:void(0)" class="app-btn cancel">Annuler</a>
                    <input type="submit" class="app-btn a-btn-success update" value="Enregistrer les modifications" />
                </div>
            </form>
        </div>
    </div>
</div>
