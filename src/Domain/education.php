<?php

namespace MuslimahGuide\Domain;

class education
{
    private int $education_id;
    private ?string $img;
    private ?string $title;
    private ?string $contents;
    private ?int $on_clicked;

    public function __construct(?string $img, ?string $title, ?string $contents, ?int $on_clicked)
    {
        $this->img = $img;
        $this->title = $title;
        $this->contents = $contents;
        $this->on_clicked = $on_clicked;
    }

    public function getEducationId(): int
    {
        return $this->education_id;
    }

    public function setEducationId(int $education_id): void
    {
        $this->education_id = $education_id;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): void
    {
        $this->img = $img;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getContents(): ?string
    {
        return $this->contents;
    }

    public function setContents(?string $contents): void
    {
        $this->contents = $contents;
    }

    public function getOnClicked(): ?int
    {
        return $this->on_clicked;
    }

    public function setOnClicked(?int $on_clicked): void
    {
        $this->on_clicked = $on_clicked;
    }




}