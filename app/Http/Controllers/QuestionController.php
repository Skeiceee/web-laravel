<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function index()
    {
        $questions = Question::with('category', 'user')
            ->latest()
            ->paginate(24);

        return view('questions.index', [
            'questions' => $questions,
        ]);
    }

    public function show(Question $question)
    {
        $user_id = 20;

        $question->load([
            'user',
            'category',
            'answers' => fn ($query) => $query->with([
                'user',
                'hearts' => fn ($query) => $query->where('user_id', $user_id),
                'comments' => fn ($query) => $query->with([
                    'user',
                    'hearts' => fn ($query) => $query->where('user_id', $user_id),
                ]),
            ]),
            'comments' => fn ($query) => $query->with([
                'user',
                'hearts' => fn ($query) => $query->where('user_id', $user_id),
            ]),
            'hearts' => fn ($query) => $query->where('user_id', $user_id),
        ]);

        return view('questions.show', [
            'question' => $question,
        ]);
    }

    public function destroy(Question $question)
    {
        $question->delete();

        return redirect()->route('home');
    }
}
