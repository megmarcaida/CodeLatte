<template>
        <tr>
            <td>{{ coursedetail.name }}</td>
            <td>{{ coursedetail.description }}</td>
        </tr>
</template>
<script>
    export default {
        props:['coursedetail'],
        http: {
            root: '/root',
            headers: {
                'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
            }
        }
    }
</script>