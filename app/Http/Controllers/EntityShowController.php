<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Entity;
use App\Models\Section;

class EntityShowController extends Controller
{

    public function __construct(){
    }

    public function index($id = null){
        // $entityEntity = EntityEntity::find(1);
        // print_r($entityEntity->parent_entity);//devuelve la "categoria" (el padre)
        // print_r('<BR><BR>');
        // print_r($entityEntity->child_entity);//devuelve el "seller" (el hijo)
        // print_r('<BR><BR>');
        // print_r($entityEntity->parent_entity->categories);//devuelve la "categoria" como objeto en si (la entidad, definida), aunque en un listado de 1 categoria
        // print_r('<BR><BR>');
        // print_r($entityEntity->child_entity->child_entities);//devuelve la relacion "EntityEntity" segun la entity_id. Voy a conocer los padres para este hijo
        // print_r('<BR><BR>');
        // print_r($entityEntity->parent_entity->child_entities);//devuelve la relacion "EntityEntity" segun la entity_id. Voy a conocer los padres para este padre (si es que tiene).
        // print_r('<BR><BR>');
        // print_r($entityEntity->parent_entity->parent_entities);//devuelve la relacion "EntityEntity" segun la parent_entity_id. Voy a conocer los hijos para este padre.
        // die;

        //Traer listado de "section" que tenga "section_categories" y "section_products" y esos mismos tengan "section"
        // y "category" y "section" y "product" respectivamente.
        $entity = Entity::find($id);

        $entity_parents = $entity->child_entities;

        $entity_children = $entity->parent_entities;

        // print_r($entity_parents);
        // print_r('<BR><BR>');
        // print_r($entity_children);
        // die;

        return view('entity.entity', array('entity_root' => $entity, 'entity_children' => $entity_children, 'entity_parents' => $entity_parents));
    }

    public function order($id = null, $orderby = null){
        $category = Category::find($id);
        return view('category.category', array('categoryProducts' => $category->categoryProducts, 'category' => $category));
    }
}
