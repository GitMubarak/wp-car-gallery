<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Trait: Single Content Settings
*/
trait CG_Single_Content_Settings 
{
    protected $fields, $settings, $options;

    protected function cg_set_single_content_settings( $post ) {

        $this->fields   = $this->cg_single_content_option_fileds();

        $this->options  = $this->cg_build_set_settings_options( $this->fields, $post );

        $this->settings = apply_filters( 'cg_detail_settings', $this->options, $post );

        return update_option( 'cg_detail_settings', serialize( $this->settings ) );

    }

    function cg_get_single_content_settings() {

        $this->fields   = $this->cg_single_content_option_fileds();
		$this->settings = stripslashes_deep( unserialize( get_option('cg_detail_settings') ) );
        
        return $this->cg_build_get_settings_options( $this->fields, $this->settings );
	}

    protected function cg_single_content_option_fileds() {

        return [
            [
                'name'      => 'cg_single_hide_overview',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'cg_single_overview_text',
                'type'      => 'text',
                'default'   => 'Overview',
            ],
            [
                'name'      => 'cg_single_hide_vacancies',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'cg_single_vacancies_text',
                'type'      => 'text',
                'default'   => 'No. of Vacancies',
            ],
            [
                'name'      => 'cg_single_hide_skills',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'cg_single_skills_text',
                'type'      => 'text',
                'default'   => 'Specific Skills',
            ],
            [
                'name'      => 'cg_single_hide_responsible',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'cg_single_responsible_text',
                'type'      => 'text',
                'default'   => 'Responsible For',
            ],
            [
                'name'      => 'cg_single_hide_requirements',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'cg_single_requirements_text',
                'type'      => 'text',
                'default'   => 'Additional Requirements',
            ],
            [
                'name'      => 'cg_single_hide_job_type',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'cg_single_job_type_text',
                'type'      => 'text',
                'default'   => 'Job Nature',
            ],
            [
                'name'      => 'cg_single_hide_education',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'cg_single_education_text',
                'type'      => 'text',
                'default'   => 'Educational Requirements',
            ],
            [
                'name'      => 'cg_single_hide_experience',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'cg_single_experience_text',
                'type'      => 'text',
                'default'   => 'Experience Requirements',
            ],
            [
                'name'      => 'cg_single_hide_loc',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'cg_single_loc_text',
                'type'      => 'text',
                'default'   => 'Job Location',
            ],
            [
                'name'      => 'cg_single_hide_salary',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'cg_single_salary_text',
                'type'      => 'text',
                'default'   => 'Salary',
            ],
            [
                'name'      => 'cg_single_hide_benefit',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'cg_single_benefit_text',
                'type'      => 'text',
                'default'   => 'Other Benefits',
            ],
            [
                'name'      => 'cg_single_hide_level',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'cg_single_level_text',
                'type'      => 'text',
                'default'   => 'Job Level',
            ],
            [
                'name'      => 'cg_hide_apply_procedure',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'cg_apply_procedure_title',
                'type'      => 'text',
                'default'   => 'How to Apply',
            ],
            [
                'name'      => 'cg_apply_procedure_content',
                'type'      => 'textarea',
                'default'   => 'Interested candidates can send their resumes to career@your-domain.com mentioning "Job Title" in the subject line.',
            ],
            [
                'name'      => 'cg_hide_apply_button',
                'type'      => 'boolean',
                'default'   => false,
            ],
            [
                'name'      => 'cg_apply_button_text',
                'type'      => 'text',
                'default'   => 'Apply Online',
            ],
        ];
    }
}