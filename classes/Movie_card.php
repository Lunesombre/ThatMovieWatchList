<?php
class Movie
{
    private int $movieId;
    private string $movieTitle;
    private string $movieOriginalTitle;
    private int $movieYear;
    private string $movieOverview;
    private string $moviePoster;

    public function __construct(
        int $movieId,
        string $movieTitle,
        string $movieOriginalTitle,
        int $movieYear,
        string $movieOverview,
        string $moviePoster
    ) {
        $this->movieId = $movieId;
        $this->movieTitle = $movieTitle;
        $this->movieOriginalTitle = $movieOriginalTitle;
        $this->movieYear = $movieYear;
        $this->movieOverview = $movieOverview;
        $this->moviePoster = $moviePoster;
    }
}
