<?php

\App\Admin\Admin::resources()->add("article", \App\Models\Article::class);
\App\Admin\Admin::resources()->add("post", \App\Models\Post::class);
\App\Admin\Admin::resources()->add("user", \App\Models\Admin\AdminUser::class);
