#query  productos , especieanimal 
SELECT wp_posts.ID,wp_posts.post_title,wp_terms.name,wp_terms.slug,wp_term_taxonomy.taxonomy, wp_term_taxonomy.term_id, wp_term_taxonomy.parent, 
if (r.isAnimal IS NULL OR r.isAnimal = 0, 0, r.isAnimal) AS isAnimal, if (r2.isAnimalRequired IS NULL OR r2.isAnimalRequired = 0, 0, r2.isAnimalRequired) AS isAnimalRequired
FROM wp_posts
  INNER JOIN wp_term_relationships ON wp_posts.ID = wp_term_relationships.object_id
  INNER JOIN wp_terms ON wp_term_relationships.term_taxonomy_id = wp_terms.term_id
  INNER JOIN wp_term_taxonomy ON wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id
  LEFT JOIN (
	SELECT wp_terms.term_id as id, if (parent = 0 && slug = 'especieanimal', true , false ) AS isAnimal
		  FROM wp_terms
	INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_id = wp_terms.term_id
	WHERE (parent = 0
	AND taxonomy = 'category'
	AND (slug = 'productos' OR slug='especieanimal'))
	)r ON r.id = wp_term_taxonomy.parent 
  LEFT JOIN (
	SELECT wp_terms.term_id as id, if (slug = 'perro' AND taxonomy = 'category', true , false ) AS isAnimalrequired
		  FROM wp_terms
	INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_id = wp_terms.term_id
	WHERE (taxonomy = 'category'
	AND slug = 'perro')
   )r2 ON r2.id = wp_term_taxonomy.term_id 
WHERE wp_posts.post_status = 'publish'
AND (wp_term_taxonomy.parent != 0 OR wp_term_taxonomy.taxonomy ="post_tag")
group by wp_posts.ID, wp_term_relationships.term_taxonomy_id, wp_term_relationships.term_taxonomy_id
ORDER BY wp_posts.ID;

#query category
SELECT 
     wp_terms.name, wp_terms.slug
  FROM wp_terms
INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_id = wp_terms.term_id
LEFT JOIN (
	SELECT wp_terms.term_id as id, if (parent = 0 && slug = 'especieanimal', true , false ) AS isAnimal
		  FROM wp_terms
	INNER JOIN wp_term_taxonomy ON wp_term_taxonomy.term_id = wp_terms.term_id
	WHERE (parent = 0
	AND taxonomy = 'category'
	AND ( slug='especieanimal'))
	)r ON r.id = wp_term_taxonomy.parent 
WHERE isAnimal = 1 AND taxonomy = 'category'

