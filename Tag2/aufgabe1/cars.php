<?php
    namespace Tag2\cars;

    abstract class defaultCar {
        public function drive() {
            return "VROOOOOOOOOOOOM!!";
        }
    }
    class car extends defaultCar
    {
        public array $model;
        public array $colour;

        /**
         * Summary of __construct
         * @param array $model Model des Auto
         * @param array $colour Farbe des Auto
         */
        public function __construct(string $model, string $colour)
        {
            $this->model[0] = "Model";
            $this->model[1] = $model;
            $this->colour[0] = "Colour";
            $this->colour[1] = $colour;
        }

        function display(): void {
            $attributes = get_object_vars($this);
            foreach ($attributes as $key => $value) {
                echo '<h2>';
                echo $value[0];
                echo '</h2>';
                echo '<br>';
                echo $value[1];
                echo '<br>';
            }
        }
    }