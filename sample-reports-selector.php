    <?php

    $purpose = array(
        array("name"=>"","DisplayName"=>"Choose one", "URL"=>""),
        array("name"=>"report_hiring_individual_general","DisplayName"=>"Hiring - Individual (General Level)", "URL"=>$_ENV["sub"]["report_hiring_individual_general"]),
        array("name"=>"report_hiring_individual_manager","DisplayName"=>"Hiring - Individual (Manager Level)", "URL"=>$_ENV["sub"]["report_hiring_individual_manager"]),
        array("name"=>"report_hiring_group","DisplayName"=>"Hiring - Group", "URL"=>$_ENV["sub"]["report_hiring_group"]),
        array("name"=>"report_hiring_candidate_feedback","DisplayName"=>"Hiring - Candidate Feedback", "URL"=>$_ENV["sub"]["report_hiring_candidate_feedback"]),
        array("name"=>"report_development_individual_general","DisplayName"=>"Development - Individual (General Level)", "URL"=>$_ENV["sub"]["report_development_individual_general"]),
        array("name"=>"report_development_individual_manager","DisplayName"=>"Development - Individual (Manager Level)", "URL"=>$_ENV["sub"]["report_development_individual_manager"]),
        array("name"=>"report_development_team","DisplayName"=>"Development - Team/Group", "URL"=>$_ENV["sub"]["report_development_team"])
    );

    $focused_insight = array(
        array("name"=>"","DisplayName"=>"Choose one", "URL"=>""),
        array("name"=>"report_competency","DisplayName"=>"Competency", "URL"=>$_ENV["sub"]["report_competency"]),
        array("name"=>"report_leadership","DisplayName"=>"Leadership", "URL"=>$_ENV["sub"]["report_leadership"]),
        array("name"=>"report_strengths","DisplayName"=>"Strengths", "URL"=>$_ENV["sub"]["report_strengths"]),
        array("name"=>"report_motivation","DisplayName"=>"Motivation", "URL"=>$_ENV["sub"]["report_motivation"]),
        array("name"=>"report_derailers","DisplayName"=>"Derailers", "URL"=>$_ENV["sub"]["report_derailers"]),
        array("name"=>"report_eq","DisplayName"=>"EQ", "URL"=>$_ENV["sub"]["report_eq"])
    );

    $job_area = array(
        array("name"=>"","DisplayName"=>"Choose one", "URL"=>""),
        array("name"=>"report_sales_roles","DisplayName"=>"Sales roles", "URL"=>$_ENV["sub"]["report_sales_roles"]),
        array("name"=>"report_service_roles","DisplayName"=>"Service roles", "URL"=>$_ENV["sub"]["report_service_roles"]),
        array("name"=>"report_technical_roles","DisplayName"=>"Technical roles", "URL"=>$_ENV["sub"]["report_technical_roles"]),
        array("name"=>"report_industry_specific","DisplayName"=>"Industry specific", "URL"=>$_ENV["sub"]["report_industry_specific"])
    );

    $spotlight = array(
        array("name"=>"","DisplayName"=>"Choose one", "URL"=>""),
        array("name"=>"report_name_1","DisplayName"=>"Report Name 1", "URL"=>$_ENV["sub"]["report_url_1"]),
        array("name"=>"report_name_2","DisplayName"=>"Report Name 2", "URL"=>$_ENV["sub"]["report_url_2"]),
        array("name"=>"report_name_3","DisplayName"=>"Report Name 3", "URL"=>$_ENV["sub"]["report_url_3"])
    );

    ?>

    <script>

        $(document).ready(function() {

        $('.select2').select2();

        $('.sample_assessments_dropdown').on('change', function(){
        const selectedOption = $(this).find('option:selected').val();
        $(`[value="${selectedOption}"]:not(:selected)`).attr('disabled', true)
        })

        var previousOption = null;
        $('.sample_assessments_dropdown').on('change', function(){
        const selectedOption = $(this).find('option:selected').val();
        $(`[value="${previousOption}"]:disabled`).attr('disabled', false);
        previousOption = null;
        $(`[value="${selectedOption}"]:not(:selected)`).attr('disabled', true);
        })
        $('.sample_assessments_dropdown').on('click', function(){
        previousOption = $(this).find('option:selected').val();
        });

        });
        
    </script>

    <div>

        <?php

        function returnDropdown($options) {
            $toReturn = '';
            $toReturn = '<div class="dropdown_input_container">';
            $toReturn .= '<select class="select2 sample_assessments_dropdown">';
            foreach($options as $option) {
                $toReturn .= '<option value="' . $option['name'] . '">' . $option['DisplayName'] . '</option>';
            }
            $toReturn .= '</select>';
            $toReturn .= '<input type="text">';
            $toReturn .= '</div>';
            return $toReturn;
        };

        echo "<p>Purpose</p>";

        for($i = 0; $i < count($purpose); $i++) {
            echo returnDropdown($purpose);
        };

        echo "<p>Focused Insight</p>";

        for($i = 0; $i < count($focused_insight); $i++) {
            echo returnDropdown($focused_insight);
        };

        echo "<p>Job Area / Industry Focus</p>";

        for($i = 0; $i < count($job_area); $i++) {
            echo returnDropdown($job_area);
        };

        echo "<p>Spotlight Reports</p>";

        for($i = 0; $i < count($spotlight); $i++) {
            echo returnDropdown($spotlight);
        };

        ?>

    </div>

    <style>
        .dropdown_input_container {
            display: flex;
            flex-direction: row;
            margin-bottom: 20px;
            width: 100%;
        }
        .dropdown_input_container select {
            width: 100%;
            margin-bottom: 10px;
        }
        .dropdown_input_container input {
            width: 100%;
        }
    </style>