<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//print_r( $cgSingleContent );
foreach ( $cgSingleContent as $option_name => $option_value ) {
    if ( isset( $cgSingleContent[$option_name] ) ) {
        ${"" . $option_name} = $option_value;
    }
}
?>
<form name="cg_single_content_settings_form" role="form" class="form-horizontal" method="post" action="" id="cg-single-content-settings-form">
    <table class="cg-single-settings-table">
        <tr>
            <th scope="row">
                <label for="cg_single_hide_overview"><?php _e('Hide Overview', JOBWP_TXT_DOMAIN); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_single_hide_overview" class="cg_single_hide_overview" id="cg_single_hide_overview"
                    <?php echo $cg_single_hide_overview ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label><?php _e('Label Text', JOBWP_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="text" name="cg_single_overview_text" id="cg_single_overview_text" class="regular-text" value="<?php esc_attr_e( $cg_single_overview_text ); ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="cg_single_hide_vacancies"><?php _e('Hide No. of Vacancies', JOBWP_TXT_DOMAIN); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_single_hide_vacancies" class="cg_single_hide_vacancies" id="cg_single_hide_vacancies"
                    <?php echo $cg_single_hide_vacancies ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label><?php _e('Label Text', JOBWP_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="text" name="cg_single_vacancies_text" id="cg_single_vacancies_text" class="regular-text" value="<?php esc_attr_e( $cg_single_vacancies_text ); ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="cg_single_hide_skills"><?php _e('Hide Specific Skills', JOBWP_TXT_DOMAIN); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_single_hide_skills" class="cg_single_hide_skills" id="cg_single_hide_skills"
                    <?php echo $cg_single_hide_skills ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label><?php _e('Label Text', JOBWP_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="text" name="cg_single_skills_text" id="cg_single_skills_text" class="regular-text" value="<?php esc_attr_e( $cg_single_skills_text ); ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="cg_single_hide_responsible"><?php _e('Hide Responsible For', JOBWP_TXT_DOMAIN); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_single_hide_responsible" class="cg_single_hide_responsible" id="cg_single_hide_responsible"
                    <?php echo $cg_single_hide_responsible ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label><?php _e('Label Text', JOBWP_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="text" name="cg_single_responsible_text" id="cg_single_responsible_text" class="regular-text" value="<?php esc_attr_e( $cg_single_responsible_text ); ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="cg_single_hide_requirements"><?php _e('Hide Additional Requirements', JOBWP_TXT_DOMAIN); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_single_hide_requirements" class="cg_single_hide_requirements" id="cg_single_hide_requirements"
                    <?php echo $cg_single_hide_requirements ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label><?php _e('Label Text', JOBWP_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="text" name="cg_single_requirements_text" id="cg_single_requirements_text" class="regular-text" value="<?php esc_attr_e( $cg_single_requirements_text ); ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="cg_single_hide_job_type"><?php _e('Hide Job Nature', JOBWP_TXT_DOMAIN); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_single_hide_job_type" class="cg_single_hide_job_type" id="cg_single_hide_job_type"
                    <?php echo $cg_single_hide_job_type ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label><?php _e('Label Text', JOBWP_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="text" name="cg_single_job_type_text" id="cg_single_job_type_text" class="regular-text" value="<?php esc_attr_e( $cg_single_job_type_text ); ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="cg_single_hide_education"><?php _e('Hide Educational Requirements', JOBWP_TXT_DOMAIN); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_single_hide_education" class="cg_single_hide_education" id="cg_single_hide_education"
                    <?php echo $cg_single_hide_education ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label><?php _e('Label Text', JOBWP_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="text" name="cg_single_education_text" id="cg_single_education_text" class="regular-text" value="<?php esc_attr_e( $cg_single_education_text ); ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="cg_single_hide_experience"><?php _e('Hide Experience Requirements', JOBWP_TXT_DOMAIN); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_single_hide_experience" class="cg_single_hide_experience" id="cg_single_hide_experience"
                    <?php echo $cg_single_hide_experience ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label><?php _e('Label Text', JOBWP_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="text" name="cg_single_experience_text" id="cg_single_experience_text" class="regular-text" value="<?php esc_attr_e( $cg_single_experience_text ); ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="cg_single_hide_loc"><?php _e('Hide Job Location', JOBWP_TXT_DOMAIN); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_single_hide_loc" class="cg_single_hide_loc" id="cg_single_hide_loc"
                    <?php echo $cg_single_hide_loc ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label><?php _e('Label Text', JOBWP_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="text" name="cg_single_loc_text" id="cg_single_loc_text" class="regular-text" value="<?php esc_attr_e( $cg_single_loc_text ); ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="cg_single_hide_salary"><?php _e('Hide Salary', JOBWP_TXT_DOMAIN); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_single_hide_salary" class="cg_single_hide_salary" id="cg_single_hide_salary"
                    <?php echo $cg_single_hide_salary ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label><?php _e('Label Text', JOBWP_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="text" name="cg_single_salary_text" id="cg_single_salary_text" class="regular-text" value="<?php esc_attr_e( $cg_single_salary_text ); ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="cg_single_hide_benefit"><?php _e('Hide Other Benefits', JOBWP_TXT_DOMAIN); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_single_hide_benefit" class="cg_single_hide_benefit" id="cg_single_hide_benefit"
                    <?php echo $cg_single_hide_benefit ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label><?php _e('Label Text', JOBWP_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="text" name="cg_single_benefit_text" id="cg_single_benefit_text" class="regular-text" value="<?php esc_attr_e( $cg_single_benefit_text ); ?>" />
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="cg_single_hide_level"><?php _e('Hide Job Level', JOBWP_TXT_DOMAIN); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_single_hide_level" class="cg_single_hide_level" id="cg_single_hide_level"
                    <?php echo $cg_single_hide_level ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label><?php _e('Label Text', JOBWP_TXT_DOMAIN); ?></label>
            </th>
            <td>
                <input type="text" name="cg_single_level_text" id="cg_single_level_text" class="regular-text" value="<?php esc_attr_e( $cg_single_level_text ); ?>" />
            </td>
        </tr>
        <tr><td colspan="4"><hr></td></tr>
        <tr>
            <th scope="row">
                <label for="cg_hide_apply_procedure"><?php _e('Hide Apply Procedure', JOBWP_TXT_DOMAIN); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_hide_apply_procedure" class="cg_hide_apply_procedure" id="cg_hide_apply_procedure"
                    <?php echo $cg_hide_apply_procedure ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label><?php _e('Apply Procedure Title', JOBWP_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="3">
                <input type="text" name="cg_apply_procedure_title" id="cg_apply_procedure_title" class="regular-text" value="<?php esc_attr_e( $cg_apply_procedure_title ); ?>" />
            </td>
        </tr>
        <tr>
            <th colspan="3" scope="row" style="text-align: right;">
                <label><?php _e('Apply Procedure Content', JOBWP_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="1">
                <textarea cols="40" style="min-height:100px;" name="cg_apply_procedure_content" class="regular-text" id="cg_apply_procedure_content"><?php esc_html_e( $cg_apply_procedure_content ); ?></textarea>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="cg_hide_apply_button"><?php _e('Hide Apply Button', JOBWP_TXT_DOMAIN); ?>?</label>
            </th>
            <td>
                <input type="checkbox" name="cg_hide_apply_button" class="cg_hide_apply_button" id="cg_hide_apply_button"
                    <?php echo $cg_hide_apply_button ? 'checked' : ''; ?> >
            </td>
            <th scope="row">
                <label><?php _e('Apply Button Text', JOBWP_TXT_DOMAIN); ?></label>
            </th>
            <td colspan="3">
                <input type="text" name="cg_apply_button_text" id="cg_apply_button_text" class="regular-text" value="<?php esc_attr_e( $cg_apply_button_text ); ?>" />
            </td>
        </tr>
    </table>
    <hr>
    <p class="submit">
        <button id="updateSingleContent" name="updateSingleContent" class="button button-primary cg-button">
            <i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;<?php _e('Save Settings', JOBWP_TXT_DOMAIN); ?>
        </button>
    </p>

</form>