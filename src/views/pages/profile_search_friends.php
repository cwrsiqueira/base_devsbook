<?= $render('header', ['loggedUser' => $loggedUser]); ?>
<section class="container main">
    <?= $render('sidebar', ['activeMenu' => 'todos-usuarios']); ?>

    <section class="feed">

        <?= $render('perfil-header', ['user' => $user, 'loggedUser' => $loggedUser, 'isFollowing' => $isFollowing]); ?>

        <div class="row">

            <div class="column">

                <div class="box">
                    <div class="box-body">

                        <div class="tabs">
                            <div class="tab-item <?= (!empty($_GET['to']) && $_GET['to'] == 'followers') ? 'active' : ''; ?>" data-for="followers">
                                Seguidores
                            </div>
                            <div class="tab-item <?= (!empty($_GET['to']) && $_GET['to'] == 'following') ? 'active' : ''; ?>" data-for="following">
                                Seguindo
                            </div>
                            <div class="tab-item <?= (!empty($_GET['to']) && $_GET['to'] == 'searching') ? 'active' : ''; ?>" data-for="searching">
                                Todos os usuários
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-body" data-item="followers">

                                <div class="full-friend-list">

                                    <?php foreach ($user->followers as $item) : ?>
                                        <div class="friend-icon" title="<?= $item->name ?>">
                                            <a href="<?= $base; ?>/perfil/<?= $item->id ?>">
                                                <div class="friend-icon-avatar">
                                                    <img src="<?= $base; ?>/media/avatars/<?= $item->avatar ?? 'default.jpg'; ?>" />
                                                </div>
                                                <div class="friend-icon-name">
                                                    <?= $item->name; ?>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>

                                </div>

                            </div>
                            <div class="tab-body" data-item="following">

                                <div class="full-friend-list">
                                    <?php foreach ($user->followings as $item) : ?>
                                        <div class="friend-icon" title="<?= $item->name ?>">
                                            <a href="<?= $base; ?>/perfil/<?= $item->id ?>">
                                                <div class="friend-icon-avatar">
                                                    <img src="<?= $base; ?>/media/avatars/<?= $item->avatar ?? 'default.jpg'; ?>" />
                                                </div>
                                                <div class="friend-icon-name">
                                                    <?= $item->name; ?>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                            <div class="tab-body" data-item="searching">

                                <div class="full-friend-list">
                                    <?php foreach ($user->allUsers as $item) : ?>
                                        <div class="friend-icon" title="<?= $item->name ?>">
                                            <a href="<?= $base; ?>/perfil/<?= $item->id ?>">
                                                <div class="friend-icon-avatar">
                                                    <img src="<?= $base; ?>/media/avatars/<?= $item->avatar ?? 'default.jpg'; ?>" />
                                                </div>
                                                <div class="friend-icon-name">
                                                    <?= $item->name; ?>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </section>

</section>
<?= $render('footer');
