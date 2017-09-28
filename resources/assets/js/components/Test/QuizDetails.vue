<template>
    <tr>
        <td>{{ quizdetail.name }}</td>
        <td>{{ quizdetail.description }}</td>
    </tr>
</template>
<script>
    export default {
        props:['quizdetail'],
        http: {
            root: '/root',
            headers: {
                'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
            }
        }
    }
</script>