# Operator Pattern

Operators are software extensions to Kubernetes that make use of custom resources to manage applications and their components.
Operators follow Kubernetes principles, notably the control loop.

The Operator pattern consists of two major components:

- Custom resource (CR): A CR is a Kube API object similar to out-of-box Kube resources like Pod, Deployment, and Service, but Kube users define most of its schema. A CR has specs and status sections, and is maintained by Kube so that users can create, read, update, and delete (CRUD) it via Kube APIs. The specs section allows users to describe the desired states of their apps in their respective languages. For example, users can create a key in CR named “replicasPerRegion,” which stores how many instances of an app each region should have.
- Control loop: A control loop is a piece of code implemented by Kube users. The loop’s job is to continually interact with Kube APIs and to compare and reconcile the reality with the desired states (CR). Hence, its other name: the reconcile loop. The loop also puts the results of the comparison and reconciliation in the CR’s status section.

Any program that follows this pattern is a Kube Operator. You might also have heard of something called the Operator SDK, but it’s nothing more than a framework to build Operators and therefore unnecessary.
