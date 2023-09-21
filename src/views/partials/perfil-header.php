<div class="row">
    <div class="box flex-1 border-top-flat">
        <div class="box-body">
            <div class="profile-cover" style="background-image: url('<?= $base; ?>/media/covers/<?= $user->cover ?? 'cover.jpg'; ?>');"></div>
            <div class="profile-info m-20 row">
                <div class="profile-info-avatar">
                    <a href="<?= $base; ?>/perfil/<?= $user->id; ?>">
                        <img src="<?= $base; ?>/media/avatars/<?= $user->avatar ?? 'default.jpg'; ?>" />
                    </a>
                </div>
                <div class="profile-info-name">
                    <div class="profile-info-name-text">
                        <a href="<?= $base; ?>/perfil/<?= $user->id; ?>">
                            <?= $user->name; ?>
                        </a>
                    </div>
                    <div class="profile-info-location"><?= $user->city; ?></div>
                </div>
                <div class="profile-info-data row">

                    <?php if ($user->id != $loggedUser->id) : ?>
                        <a href="<?= $base; ?>/perfil/<?= $user->id; ?>/follow" class="button"><?= (!$isFollowing) ? 'Seguir' : 'Não Seguir'; ?></a>
                    <?php endif; ?>

                    <div class="profile-info-item m-width-20">
                        <a href="<?= $base; ?>/perfil/<?= $user->id ?>/amigos?to=followers">
                            <div class="profile-info-item-n"><?= count($user->followers) ?></div>
                            <div class="profile-info-item-s">Seguidores</div>
                        </a>
                    </div>
                    <div class="profile-info-item m-width-20">
                        <a href="<?= $base; ?>/perfil/<?= $user->id ?>/amigos?to=following">
                            <div class="profile-info-item-n"><?= count($user->followings) ?></div>
                            <div class="profile-info-item-s">Seguindo</div>
                        </a>
                    </div>
                    <div class="profile-info-item m-width-20">
                        <a href="<?= $base; ?>/perfil/<?= $user->id ?>/fotos">
                            <div class="profile-info-item-n"><?= count($user->photos) ?></div>
                            <div class="profile-info-item-s">Fotos</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>