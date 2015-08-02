<?php
namespace Skava;

class Customize {

	public $controlTypes;

	public $defaultType = array(
		'type' => 'theme_mod'
	);


	public static function register()
	{
		return new self;
	}


	protected function __construct()
	{
		$this->wpCustomize = $GLOBALS['wp_customize'];
	}


	public function addSection(
		$id,
		$panel = null,
		$name,
		$desc = null,
		$weight = 30
	) {
		if ( $panel )
		{
			$this->wpCustomize->add_section($id, array(
					'title'       => __($name, 'skava'),
					'description' => $desc,
					'priority'    => $weight,
					'panel'       => $panel
				));
		}
		else
		{
			$this->wpCustomize->add_section($id, array(
					'title'       => __($name, 'skava'),
					'description' => $desc,
					'priority'    => $weight,
				));
		}

		return $this;
	}


	public function addPanel($id, $name, $desc = null, $weight = 30)
	{
		$this->wpCustomize->add_panel($id, array(
				'title'       => __($name, 'skava'),
				'description' => $desc,
				'priority'    => $weight
			));

		return $this;
	}


	public function addTextBox($name, $section, $label, $desc = null)
	{
		$this->wpCustomize->add_setting($name, array(
				'type' => 'theme_mod'
			));
		$this->wpCustomize->add_control($name, array(
				'section'     => $section,
				'type'        => 'text',
				'label'       => $label,
				'description' => $desc,
			));

		return $this;
	}


	public function addCheckBox($name, $section, $label, $desc = null)
	{
		$this->wpCustomize->add_setting($name, $this->defaultType);
		$this->wpCustomize->add_control($name, array(
				'section'     => $section,
				'type'        => 'checkbox',
				'label'       => $label,
				'description' => $desc,
			));

		return $this;
	}


	public function addRadioButtons(
		$name,
		$section,
		$label,
		$desc = null,
		$choices = array()
	) {
		$this->wpCustomize->add_setting($name, $this->defaultType);
		$this->wpCustomize->add_control($name, array(
				'section'     => $section,
				'type'        => 'radio',
				'label'       => $label,
				'description' => $desc,
				'choices'     => $choices,
			));

		return $this;
	}


	public function addSelectList(
		$name,
		$section,
		$label,
		$desc = null,
		$choices = array()
	) {
		$this->wpCustomize->add_setting($name, $this->defaultType);
		$this->wpCustomize->add_control($name, array(
				'section'     => $section,
				'type'        => 'select',
				'label'       => $label,
				'description' => $desc,
				'choices'     => $choices,
			));

		return $this;
	}


	public function addFileUpload($name, $section, $label, $desc = null)
	{
		$this->wpCustomize->add_setting($name);
		$this->wpCustomize->add_control(new \WP_Customize_Upload_Control($this->wpCustomize, $name, array(
					'section'     => $section,
					'label'       => $label,
					'settings'    => $name,
					'description' => $desc,

				)));

		return $this;
	}


	public function addImageUpload($name, $section, $label, $desc = null)
	{
		$this->wpCustomize->add_setting($name);
		$this->wpCustomize->add_control(new \WP_Customize_Image_Control($this->wpCustomize, $name, array(
					'section'     => $section,
					'label'       => $label,
					'settings'    => $name,
					'description' => $desc,

				)));

		return $this;
	}


	public function addTextArea($name, $section, $label, $desc = null)
	{
		$this->wpCustomize->add_setting($name);
		$this->wpCustomize->add_control(new WP_Customize_Textarea_control($this->wpCustomize, $name, array(
					'section'     => $section,
					'label'       => $label,
					'settings'    => $name,
					'description' => $desc,
				)));

		return $this;
	}
}
