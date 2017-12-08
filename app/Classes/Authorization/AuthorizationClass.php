<?php

namespace App\Classes\Authorization;

use Dlnsk\HierarchicalRBAC\Authorization;


/**
 *  This is example of hierarchical RBAC authorization configiration.
 */

class AuthorizationClass extends Authorization
{
	public function getPermissions() {
		return [
            'update-post' => [
                // Необязательное свойство "описание"
                'description' => 'Редактирование любых статей',
                // Используется для создания цепи (иерархии) операций
                'next' => 'update-post-in-category',
            ],
            'update-post-in-category' => [
                'description' => 'Редактирование статей в определенной категории',
                'next' => 'update-own-post',
            ],
            'update-own-post' => [
                'description' => 'Редактирование собственных статей',
                // Здесь цепь заканчивается
            ],
            // Избранное
            'add-to-favorites' => [
                'description' => 'Добавление статьи в список избранных',
            ],
		];
	}

    public function getRoles() {
        return [
            'admin' => [
                'update-post',
            ],
            'manager' => [
                'update-post-in-category',
            ],
            'user' => [
                'update-own-post',
                'add-to-favorites',
            ],
        ];
    }

    public function updatePostInCategory($user, $post, $permission) {
        // Данный метод возвращает модель в случае, если $post содержит id модели
        $post = $this->getModel(\App\Models\IcoItems::class, $post);

        return $user->category_id === $post->category_id;
    }

    public function updateOwnPost($user, $post, $permission) {
        $post = $this->getModel(\App\Models\IcoItems::class, $post);

        return $user->id === $post->user_id;
    }



	/**
	 * Methods which checking permissions.
	 * Methods should be present only if additional checking needs.
	 */
//
//	public function editOwnPost($user, $post) {
//		$post = $this->getModel(\App\Post::class, $post);  // helper method for geting model
//
//		return $user->id === $post->user_id;
//	}

}
