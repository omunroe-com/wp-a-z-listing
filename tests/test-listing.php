<?php
class AZ_Listing_Tests extends AZ_UnitTestCase {
	public function test_empty_letters() {
		$expected = file_get_contents( 'tests/default-letters.txt' );
		$actual   = get_the_a_z_letters();

		$this->assertHTMLEquals( $expected, $actual );
	}
	public function test_empty_listing() {
		$expected = file_get_contents( 'tests/default-listing.txt' );
		$actual   = get_the_a_z_listing();

		$this->assertHTMLEquals( $expected, $actual );
	}

	public function test_populated_letters() {
		$p = $this->factory->post->create(
			array(
				'post_title' => 'Test Page',
				'post_type'  => 'page',
			)
		);
		$q = new WP_Query(
			array(
				'post_type' => 'page',
			)
		);

		$expected = file_get_contents( 'tests/populated-letters.txt' );
		$actual   = get_the_a_z_letters( $q );

		$this->assertHTMLEquals( $expected, $actual );
	}

	public function test_populated_letters_linked() {
		$p = $this->factory->post->create(
			array(
				'post_title' => 'Test Page',
				'post_type'  => 'page',
			)
		);
		$q = new WP_Query(
			array(
				'post_type' => 'page',
			)
		);

		$expected = file_get_contents( 'tests/populated-letters-linked.txt' );
		$actual   = get_the_a_z_letters( $q, '/test-path' );

		$this->assertHTMLEquals( $expected, $actual );
	}

	public function test_populated_listing() {
		$title = 'Test Page';
		$p     = $this->factory->post->create(
			array(
				'post_title' => $title,
				'post_type'  => 'page',
			)
		);
		$q     = new WP_Query(
			array(
				'post_type' => 'page',
			)
		);

		$expected = sprintf( file_get_contents( 'tests/populated-listing.txt' ), $title, $p );
		$actual   = get_the_a_z_listing( $q );

		$this->assertHTMLEquals( $expected, $actual );
	}

	public function test_populated_taxonomy_listing() {
		$title = 'Test Category';
		$t     = $this->factory->term->create(
			array(
				'name'     => $title,
				'taxonomy' => 'category',
			)
		);

		$expected = sprintf( file_get_contents( 'tests/populated-taxonomy-listing.txt' ), $title, $t );
		$actual   = get_the_a_z_listing( 'category' );

		$this->assertHTMLEquals( $expected, $actual );
	}

	public function test_populated_lowercase_letters() {
		$p = $this->factory->post->create(
			array(
				'post_title' => 'test page',
				'post_type'  => 'page',
			)
		);
		$q = new WP_Query(
			array(
				'post_type' => 'page',
			)
		);

		$expected = file_get_contents( 'tests/populated-letters.txt' );
		$actual   = get_the_a_z_letters( $q );

		$this->assertHTMLEquals( $expected, $actual );
	}

	public function test_populated_lowercase_letters_linked() {
		$p = $this->factory->post->create(
			array(
				'post_title' => 'test page',
				'post_type'  => 'page',
			)
		);
		$q = new WP_Query(
			array(
				'post_type' => 'page',
			)
		);

		$expected = file_get_contents( 'tests/populated-letters-linked.txt' );
		$actual   = get_the_a_z_letters( $q, '/test-path' );

		$this->assertHTMLEquals( $expected, $actual );
	}

	public function test_populated_lowercase_listing() {
		$title = 'test page';
		$p     = $this->factory->post->create(
			array(
				'post_title' => $title,
				'post_type'  => 'page',
			)
		);
		$q     = new WP_Query(
			array(
				'post_type' => 'page',
			)
		);

		$expected = sprintf( file_get_contents( 'tests/populated-listing.txt' ), $title, $p );
		$actual   = get_the_a_z_listing( $q );

		$this->assertHTMLEquals( $expected, $actual );
	}

	public function test_populated_lowercase_taxonomy_listing() {
		$title = 'test category';
		$t     = $this->factory->term->create(
			array(
				'name'     => $title,
				'taxonomy' => 'category',
			)
		);

		$expected = sprintf( file_get_contents( 'tests/populated-taxonomy-listing.txt' ), $title, $t );
		$actual   = get_the_a_z_listing( 'category', false );

		$this->assertHTMLEquals( $expected, $actual );
	}
}
