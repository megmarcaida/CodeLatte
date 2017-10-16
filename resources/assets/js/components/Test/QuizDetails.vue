<template>
        <tr>
            <td>{{ quizDetail.question_text }}</td>
            <td>{{ quizDetail.answer_explanation }}</td>
            <td>{{ quizDetail.correct_answer }}</td>
        </tr>
</template>
<script>
    export default {
        props:['quizDetail'],
        http: {
            root: '/root',
            headers: {
                'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
            }
        }
    }
</script>