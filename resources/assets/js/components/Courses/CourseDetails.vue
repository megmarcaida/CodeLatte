<template>

<tbody>

        <td colspan="2">{{ coursedetail.name }}</td>
        <td colspan="2">{{ coursedetail.description }}</td>
</tbody>
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