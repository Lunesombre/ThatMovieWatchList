<?php
class Movie
{
    public function __construct(
        private string $movieTitle,
        private string $movieOriginalTitle,
        private int $movieYear,
        private string $movieOverview,
        private string $moviePoster,
    ) {

    }

        /**
         * Get the value of movieTitle
         */ 
        public function getMovieTitle()
        {
                return $this->movieTitle;
        }

        /**
         * Get the value of movieOriginalTitle
         */ 
        public function getMovieOriginalTitle()
        {
                return $this->movieOriginalTitle;
        }

        /**
         * Get the value of movieYear
         */ 
        public function getMovieYear()
        {
                return $this->movieYear;
        }

        /**
         * Get the value of movieOverview
         */ 
        public function getMovieOverview()
        {
                return $this->movieOverview;
        }

        /**
         * Get the value of moviePoster
         */ 
        public function getMoviePoster()
        {
                return $this->moviePoster;
        }
}
